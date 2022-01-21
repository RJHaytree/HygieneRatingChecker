<?php require('./components/header.php'); ?>

<div class="main">
    <div class="header">
        <h1>Restaurant Hygiene Checker</h1>
    </div>
    <div class="content">
        <div class="search-bar">
            <div class="forms">
                <div class="form-row justify-content-md-center">
                    <div class="col-md-10">
                        <form id="search-radius-form" name="search-name" class="form-inline" accept-charset="UTF-8">
                            <div class="input-group flex-fill">
                                <input id="search-name" type="search" name="name" id="search" value="" placeholder="Restaurant Name" class="form-control" aria-label="Search for a restaurant">
                                <div class="input-group-append">
                                    <button name="search" class="btn" id="search-name-btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-auto">
                        <form id="search-radius-form" name="search-radius" class="form-inline" accept-charset="UTF-8">
                            <div class="input-group">
                                <input id="search-radius" type="" name="name" id="search" value="1" placeholder="1" class="form-control" aria-label="Search in this radius" style="width: 40px;">
                                <div class="input-group-append">
                                    <button name="search" class="btn" id="search-radius-btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-content" style="margin-top: 15px;">
            <div class="modal fade bs-example-modal-lg" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mapModalTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="map-canvas">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger" role="alert">
                Some restaurants may be shown without ratings despite being allocated a rating by their local council. This is due to the name they have registered with their council not matching the name registered with Google LLC. This is especially prevalent with franchise restaurants, who register the local town within the name of the restaurant.
            </div>
            <div class="loading d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="list" class="col-md-12"></div>
        </div>
    </div>

    <footer class="bg-light">
        <div class="text-center">
            <p>&copy; Ryan Haytree</p>
            <hr>
        </div>
    </footer>
</div>

<?php require('./components/footer.php'); ?>