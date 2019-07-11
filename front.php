<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Ovdje ide forma</h1>
<form action="/devices" method="get">
    <select name="test[]" id="sss" multiple>
        <option value="devices">1</option>
        <option value="benign_traffic">2</option>
        <option value="attacks">3</option>
    </select>

    <input type="submit" class="submit" value="submit" id="btn" name="devices">
</form>

<script>

    const btn = document.getElementById('btn');
    const so = document.getElementById('sss');

    let val = '';

    so.addEventListener('change', (e) => {
        val = e.target.value;
        console.log(val)
    });

    btn.addEventListener('click', (e) => {
        e.preventDefault();
        fetch(val)
            .then(response => response.json())
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            })
    })
</script>
</body>
</html>