<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css">
    <style>
        .no-data-box {
            text-align: center;
            padding: 20px;
        }
        .icon-hover-circle:hover {
            cursor: pointer;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<?php include('partials/_header.php') ?>
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="11" id="checkFileName">

<div class="content">
    <?php include("partials/_navbar.php"); ?>

    <main class="p-4">
        <div class="mb-4">
            <h1>Bus Service</h1>
            <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-bus"></i> Bus Requests
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    <i class="fas fa-bus"></i> Accepted Requests
                </button>
                     <!-- Button -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#mapModal">
                    <i ></> 📍School Location
                </button>

<!-- Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="mapModalLabel">School Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div style="width: 100%; height: 400px;">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.255328924236!2d77.06516!3d28.514535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d19657bc1ffbf%3A0x105c16c01c337de9!2sModern%20Perfect%20Public%20School!5e0!3m2!1sen!2sin!4v1714825395221"
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</div>
            </div>
        </div>
    
        <!-- Bus Request Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Request for Bus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="request"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accepted Request Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Requests Accepted by Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="p-3">
                        <input type="search" id="search" class="form-control mb-3" placeholder="Search by name or ID">
                        <div id="request-accept"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bus and Route Display -->
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><i class='bx bxs-bus me-2'></i>Buses</h5>
                            <span id="open-add-bus-dailog" class="icon-hover-circle"><i class='bx bx-plus'></i></span>
                        </div>
                        <div id="accordion-bus-list" class="accordion accordion-flush"></div>
                        <div id="No-Buses" class="dataNotAvailable text-center mt-3">
                            <div class="no-data-box">
                                <i class='bx bxs-bus fs-1'></i>
                                <p>No Buses</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3"><i class='bx bxs-map me-2'></i>Bus Route</h5>
                        <?php include("partials/bus-shared/bus-root-gui.php"); ?>
                        <div id="No-Bus-selected" class="dataNotAvailable text-center mt-3">
                            <div class="no-data-box">
                                <i class='bx bxs-bus-school fs-1'></i>
                                <p>No Bus Route</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">

      

<?php include('partials/_footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bus.js"></script>
<script src="js/date-picker.min.js"></script>
<script>
    $(document).ready(function(){
        $.post("partials/bus-requests.php", function(data){
            $("#request").html(data);
        });
        $.post("partials/load-bus.php", function(data){
            $("#request-accept").html(data);
        });

        document.getElementById("search").addEventListener("keyup", function() {
            var val = this.value;
            var formData = new FormData();
            formData.append("val", val);
            fetch("partials/search-bus.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("request-accept").innerHTML = data;
            })
            .catch(error => console.error("Error:", error));
        });
    });

    new DatePicker({
        el: '#arrival-time-new-picker',
        toggleEl: '#new-arrival-toggler',
        inputEl: '#arrival-time-new',
        type: 'HOUR'
    });

    new DatePicker({
        el: '#arrival-time-edit-picker',
        toggleEl: '#edit-arrival-toggler',
        inputEl: '#arrival-time-edit',
        type: 'HOUR'
    });
</script>
</body>
</html>