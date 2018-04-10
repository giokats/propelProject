<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contacts</title>
        <style type="text/css">
            table.contacts {
                width: 100%;
            }
            
            table.contacts thead {
                background-color: #eee;
                text-align: left;
            }
            
            table.contacts thead th {
                border: solid 1px #fff;
                padding: 3px;
            }
            
            table.contacts tbody td {
                border: solid 1px #eee;
                padding: 3px;
            }
            
            a, a:hover, a:active, a:visited {
                color: blue;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div><a href="index.php?op=new">Add new contact</a></div>
        <table class="contacts" border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><a href="?orderby=name">Name</a></th>
                    <th><a href="?orderby=phone">Phone</a></th>
                    <th><a href="?orderby=email">Email</a></th>
                    <th><a href="?orderby=address">Address</a></th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><a href="index.php?op=show&id=<?php print $contact->getId(); ?>"><?php print $contact->getName(); ?></a></td>
                    <td><?php print $contact->getPhone(); ?></td>
                    <td><?php print $contact->getEmail(); ?></td>
                    <td><?php print $contact->getAddress(); ?></td>
                    <td><a href="index.php?op=edit&id=<?php print $contact->getId(); ?>">edit</a></td>
                    <td><a href="index.php?op=delete&id=<?php print $contact->getId(); ?>">delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
