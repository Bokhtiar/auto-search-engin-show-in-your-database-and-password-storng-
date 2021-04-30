<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Auto Complete Search Using Typeahead - MyNotePaper.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width: 750px; margin-top: 50px;">
    <div class="text-center">
        <h5 class="text-center">Laravel + Typeahead Auto Complete Search</h5>
        <input type="text" class="form-control typeahead" placeholder="Start typing something to search...">
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var path = "{{ route('autocomplete.search.query') }}";
    $('input.typeahead').typeahead({
        source: function (query, process) {
            return $.get(path, {query: query}, function (data) {
                return process(data);
            });
        }
    });
</script>
</html>
