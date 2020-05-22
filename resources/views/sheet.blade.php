<html>
    <head>
        {{-- Heading --}}
    </head>
    <body>
        <form action="/" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="sheet" id="sheet" accept=".xlsx">
            <input type="submit" value="Submit">
        </form>
    </body>
</html>