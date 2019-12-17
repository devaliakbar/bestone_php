<?php include('includes/header.php'); ?>


<main class="user-profiles">
    <div class="head">
        <h1>Customers</h1>

        <form action="" class="form-inline">

            <div class="form-group">
                <input placeholder="Name" type="text" id="name">
            </div>
            <div class="form-group">
                <input placeholder="User Name" type="text" id="username">
            </div>
            <div class="form-group">
                <input placeholder="Phone" type="text" id="phone">
            </div>
            <div class="form-group">
                <input placeholder="E-mail" type="email" id="email">
            </div>
            <div class="form-group">
                <button class="btn g" id="refresh">Refresh</button>
            </div>
        </form>
    </div>

    </div>


    <div class="content">
        <div class="table-wrapper">
            <table border="1">
                <thead>
                    <tr>
                         <th class='grid-id'>
                            Id
                        </th>
                        <th class='grid-name'>
                            Name
                        </th>
                        <th class='grid-user'>
                            User name
                        </th>
                        <th class='grid-phone'>
                            Phone
                        </th>
                        <th class='grid-email'>
                            E mail
                        </th>
                       
                    </tr>
                </thead>
                <tbody id="grid-data">
                 
                </tbody>
            </table>
        </div>
    </div>

</main>
<script src="js/profile.js"></script>
<?php include('includes/footer.php'); ?>