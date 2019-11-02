@foreach ($fields as $item)
<div class="form-group">
    <label for="{{ $item['key'] }}">{{ $item['caption'] }}</label>
    @if ($item['htmlElement'] === 'text')
    <input type="{{ $item['type'] }}" class="form-control @error($item['key']) is-invalid @enderror"
        name="{{ $item['key'] }}" id="{{ $item['key'] }}"
        value="{{ isset($data) ? $data[$item['key']] : old($item['key']) }}">
    @endif

    @if ($item['htmlElement'] === 'select')
    <select name="{{ $item['key'] }}" id="{{ $item['key'] }}"
        class="form-control @error($item['key']) is-invalid @enderror">
        @if (isset($item['selectValue']))
        @foreach ($item['selectValue'] as $select)
        <option value="{{ $select['id'] }}" @if(isset($data) && $data[$item['key']]===$select['id']) selected="selected"
            @endif>{{ $select['name'] }}</option>
        @endforeach
        @endif
    </select>
    @endif

    @if ($item['htmlElement'] === 'textarea')
    <textarea class="form-control @error($item['key']) is-invalid @enderror" name="{{ $item['key'] }}"
        id="{{ $item['key'] }}">{{ isset($data) ? $data[$item['key']] : old($item['key']) }}
    </textarea>
    @endif

    @error($item['key'])
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
@endforeach
<div class="float-right">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
@if (count($errors) > 0)
<div class="error">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
