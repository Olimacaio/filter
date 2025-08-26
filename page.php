<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Filter Test</title>
    <?php wp_head(); ?>
</head>

<body>
    <div class="page">

        <!-- header -->
        <header id="site-header" class="container-fluid bg-black text-white">
            <div class="container">
                <div class="row py-3">
                    <div class="col-12 col-md-4"><img src="./logo.png" alt="Site Logo"></div>
                    <div class="col-12 col-md-8 text-end">
                        <ul id="header-menu" class="menu d-inline-flex gap-3 list-unstyled">
                            <li>Menu A</li>
                            <li>Menu B</li>
                            <li>Menu C</li>
                            <li>Menu D</li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- content -->
        <main id="content" class="container-fluid">
            <div class="container">
                <div class="row py-5">
                    <div class="col-12">

                        <h1 class="page-title">Filter Test</h1>

                        <!-- form -->
                        <form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
                            <input type="text" id="filter-input" placeholder="Search posts...">
                        </form>

                        <!-- results -->
                        <div id="filter-results"></div>

                    </div>
                </div>
            </div>
        </main>

        <!-- footer -->
        <footer class="container-fluid bg-black text-white">
            <div class="container">
                <div class="row py-3">
                    <div class="col-12">
                        <p><?php echo date('Y'); ?> &copy; All rights reserved!</p>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <!-- Jquery/Ajax filter -->
    <script>
        jQuery(document).ready(function($) {
            $('#filter-input').on('keyup', function() {
                var search = $(this).val();

                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'myfilter',
                        search: search
                    },
                    success: function(response) {
                        $('#filter-results').html(response);
                    }
                });
            });
        });
    </script>


</body>

</html>
