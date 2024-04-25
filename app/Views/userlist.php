<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="submit"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>
    <h1>User List</h1>
    <form action="/Tri" method="post">
        <input type="text" name="rech">
        <input type="submit" value="search">
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>mdp</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['mdp'] ?></td>                    
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['tel'] ?></td>
                    <td><?= $user['adresse'] ?></td>
                    <td><form action="/Modif" method="post">
                        <input type="text" name="m_mod" value="<?= $user['username'] ?>" hidden>
                        <input type="submit" value="modifier">
                    </form><form action="/Modif" method="post">
                        <input type="text" name="m_suppr" value="<?= $user['username'] ?>" hidden>
                        <input type="submit" value="supprimer">
                    </form></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links()?>
</body>
</html>
