<?php use Domain\Entity\Contact; ?>
<!DOCTYPE html>
<html lang="en">
    <?php templatePart('header') ?>
    <body>
        <div class="container">
            <h1>Mailing List</h1>

            <?php templatePart('add-contact') ?>
            <div class="mb-3"></div>
            <table id="contact-list" class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /** @var Contact[] $contacts */
                foreach ($contacts as $contact)  { ?>
                    <tr data-id="<?= $contact->id ?>">
                        <td><?= $contact->name ?></td>
                        <td><?= $contact->email ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger delete-contact">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html