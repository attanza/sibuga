<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotaion#{{ $data->no }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
</head>

<body>
    <div class="container pt-5">
        <h3>Generate PDF</h3>
        <form action="/manage/quotations/{{ $data->id }}/pdf" method="POST">
            @csrf
            <div class="form-group mt-3">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" placeholder="Location" value="Bandung">
            </div>
            <div class="form-group">
                <label for="date">Date</label>

                <input type="text" class="form-control" name="date" id="date" placeholder="Date"
                    value="{{ $data->created_at->format('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>

                <select class="form-control" name="contact_id" style="width: 30%;">
                    @if(isset($data->customer) && isset($data->customer->contacts))
                    @foreach ($data->customer->contacts as $contact)
                    <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="footer">Footer</label>
                <textarea name="footer" id="summernote">
                    {{ $initialFooter ?? '' }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="initiator">Initiator</label>
                <select name="initiator" class="form-control">
                    @foreach ($users as $user)
                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <a href="/manage/quotations/{{ $data->id }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Generate</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
        $(document).ready(function(){

            $('#date').datepicker({
                format: 'yyyy-mm-dd',
            });

            $('#summernote').summernote({
                placeholder: 'Hello bootstrap 4',
                tabsize: 2,
                height: 250
            });
        });
    </script>
</body>

</html>
