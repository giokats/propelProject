<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php print $contact->getName(); ?></title>
    </head>
    <body>
        <h1><?php print $contact->getName(); ?></h1>
        <div>
            <span class="label">Phone:</span>
            <?php print $contact->getPhone(); ?>
        </div>
        <div>
            <span class="label">Email:</span>
            <?php print $contact->getEmail(); ?>
        </div>
        <div>
            <span class="label">Address:</span>
            <?php print $contact->getAddress(); ?>
        </div>
    </body>
</html>
