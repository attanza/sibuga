<?php

namespace App\Traits;

use App\Models\Contact;
use App\Models\Quotation;
use App\User;
use Carbon\Carbon;

trait PdfTrait
{
    public function pdfForm($id)
    {
        $initialFooter = "
        <ul>
<li>Harga termasuk ongkos kirim</li>
<li>Desain sesuai dengan permintaan dan dianggap fixed setelah PO (purchase order) disetujui</li>
<li>Penambahan atau pengurangan permintaan oleh konsumen akan dikenakan penawaran baru</li>
<li>Pembayaran dilakukan cash sebelum barang dikirimkan</li>
<li>Harga sudah termasuk PPH 2% dan tidak termasuk PPN 10%</li>
<li>Pembayaran dilakukan dengan cara transfer ke rekening:
<table>
<tbody>
<tr>
<td>Nama Bank:</td>
<td>Mandiri KCP Bandung Metro</td>
</tr>
<tr>
<td>No Rekening:</td>
<td>130-00-1725711-7</td>
</tr>
<tr>
<td>Nama Penerima:</td>
<td>CV SIBUGA LANGGENG JAYA</td>
</tr>
</tbody>
</table>
</li>
</ul>
        ";
        $users = User::select('name')->get();
        $data = Quotation::find($id);
        return view('quotation.pdf')->with([
            'data' => $data,
            'initialFooter' => $initialFooter,
            'users' => $users
        ]);
    }

    public function previewPdf($request, $id)
    {
        $q = Quotation::find($id);
        $date = Carbon::parse($request->date);
        $contact = Contact::find($request->contact_id);
        $products = [];
        $i = 1;
        foreach ($q->products as $product) {
            array_push($products, [
                'no' => $i,
                'name' => $product->product->name,
                'price' => number_format($product->price),
                'qty' => $product->qty,
                'subTotal' => number_format($product->qty * $product->price),
                'note' => $product->note
            ]);
            $i++;
        }
        $prefix = 'Bapak';
        if (isset($contact)) {
            $prefix = $contact->gender === 'Male' ? 'Bapak' : 'Ibu';
        }

        $data = [
            'no' => $q->no,
            'location' => $request->location,
            'date' => $date->format('d F Y'),
            'contact' => isset($contact) ? $contact->name : '',
            'prefix' => $prefix,
            'customer' => $q->customer->name,
            'address' => $q->customer->address,
            'title' => $q->title,
            'products' => $products,
            'footer' => $request->footer,
            'initiator' => $request->initiator
        ];
        return view('quotation.pdfForDownload')->withData(collect($data));
    }
}
