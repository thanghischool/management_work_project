<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        async function logMovies() {
            // const response = await fetch("http://127.0.0.1:8000/api/cards/1", {
            //     method: "POST", // *GET, POST, PUT, DELETE, etc.
            //     headers: {
            //         'Accept': 'application/json',
            //         'Content-Type': 'application/json'
            //     },
            //     body: JSON.stringify({
            //         index : 3,
            //         list_ID : 2,
            //         title: 'Hoang Quoc',
            //         description: "Test"
            //     })
            // });
            const response = await fetch("http://127.0.0.1:8000/api/cards/description/4",{
                method: "PUT", // or 'PUT'
                headers: {
                    'Accept':'application/json',
                    'Content-Type':'application/json',
                },
                body: JSON.stringify({
                    description: 'Test update descript'
                })
            });
            const movies = await response.json();
            console.log(movies);
        }
        logMovies();
    </script>
</body>
</html>