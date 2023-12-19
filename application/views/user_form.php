<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Info CRUD_application New</title>
    <style>
        /* .table{
            width: 80%;
            margin: auto;
        } */
    </style>
    <!-- <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"> -->
    <link rel="stylesheet" href="<?= base_url()?>assets/bootstrap/css/bootstrap.min.css">
    <script src='<?= base_url()?>assets/bootstrap/js/bootstrap.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container" style="padding-top:10px">
        <h3>User Info</h3>
        <hr>
        <form name="createuser" id="createuser" class="w3-container w3-card">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Name 54546</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name Please"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="" id="email" class="form-control" placeholder="Your Email Please"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="" id="pass" class="form-control" placeholder="Write Password Here"
                            title="contains atleast 1 digit, 1 uppercase, 1 lowercase, 1 speacial symbol and 8 char"
                            required>
                    </div>
                    <!-- pattern="[a-zA-Z0-9]{8,}" -->
                    <!-- /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z](?=.*[!@#$%^&*_=+-]){8,}$/ -->
                    <div class="form-group">
                        <label for="" id="cg">College</label>
                        <select class="form-select" aria-label="Defualt select example" name="clg" id="clg" required>
                            <option value="1">TKIET</option>
                            <option value="2">KIT</option>
                            <option value="3">RIT</option>
                            <option value="4">DKTE</option>
                            <option value="5">SIT</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Department</label>
                        <select class="form-select" aria-label="Default select example" name="dept" id="dept" required>
                            <option value="1" selected>IT</option>
                            <option value="2">CSE</option>
                            <option value="3">CIVIL</option>
                            <option value="4">MECH</option>
                            <option value="5">CHEMICAL</option>
                            <option value="6">ENTC</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Joining</label>
                        <!-- <input type="date" name="" id="dob" class="form-control" placeholder="Choose Your Date of Joining" required> -->
                        <input type="text" name="" id="dob" class="form-control" onfocus="(this.type='date')"
                            onblur="(this.type='text')" placeholder="Choose Your Date of Joining" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add User" class="btn btn-primary" id="add_user">
                        <!-- <button class="btn btn-primary" id="add_user">Add User</button> -->
                    </div>
                </div>
            </div>
        </form>
        <!-- <div class="form-group">
            <button class="btn btn-primary" id="add_user">Add User</button>
        </div> -->
    </div>

    <div class="display-info">
        <table class="table table-striped" id="myTable" style="align:center;  display:none; margin-left:10%;">
            <thead>
                <tr>
                    <th style="display:none;">Sr. No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>College</th>
                    <th>Department</th>
                    <th>Date of Joining</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="form-data">

            </tbody>
        </table>
    </div>



    <script>
        $(document).ready(function () {
            const adminUrl = "<?= base_url()?>";
            $('#createuser')[0].reset();
            $(".form-select").select2();
            $(".form-select").select2({
                placeholder: "Please select value",
                allowClear: true
            });
            $("#dept").select2("val", " ");
            $("#clg").select2("val", " ");

            // $('#add_user').on('click', function(e){
            //     e.preventDefault();
            //     let formData =new formData(this);
            //     // let formData = $('#createuser').serialize();
            //     console.log(formData);
            //     return false;
            // })
            // $("#createuser").submit(function(e){
            //     e.preventDefault();
            //     formInfo = $('#createuser');
            //     let form_data = new formData(formInfo);
            //     console.log(form_data);
            //     return false;
            // })

            $('#add_user').on("click", function (e) {
                console.log("inside add button");
                var name = $("#name").val();
                var email = $("#email").val();
                var dept_ids = $("#dept").val();
                var dept_values = $("#dept").find(":selected").text();
                var clg_ids = $("#clg").val();
                var clg_values = $("#clg").find(":selected").text();
                var dob = $("#dob").val();
                var count = $('#myTable tr').length;
           
                if (name && email && dept_ids && dept_values && dob && checkPassword()) {
                    $('#myTable').css('display', "block");
                    $("#dept").select2("val", "");
                    $('#dept').val(null).trigger('change');
                    $('#createuser')[0].reset();
                    $('#myTable tbody').append('<tr id="' + count + '" class="child"><td  id="name_' + count + '">' + name + '</td><td id="email_' + count + '">' + email + '</td> <td id="clg_'+count+'"> '+ clg_values+'</td> <td id="dept_ids_' + count + '">' + dept_values + '  </td><td id="dob_' + count + '">' + dob + '</td><td><a href="javascript:void(0);" class="edit-row btn btn-small btn-primary" data-srno="' + count + '" id="editBtm" onclick="return editBtn(' + count + ')">Edit</a> &nbsp <a href="javascript:void(0);" class="remove-row btn btn-small btn-danger" data-srno="' + count + '" id="removeBtm" onclick="return removeBtn(' + count + ')">Remove</a> </td> <input type="hidden" id="dept_values_' + count + '" value=' + dept_ids + '> </tr>');
                }
            })

            // $("#clg").on('change', function () {
            //     var clg_id = $(this).val();
            //     var clg_val = $(this).find(":selected").text();
            //     var optArr =  {
            //         'id' :clg_id, 'val' :clg_val,
            //     };
            //     console.log(JSON.stringify(optArr));
            //     console.log(optArr);
            //     console.log(clg_val, clg_id);
            //     // if(clg_val == 'TKIET'){
            //     //     var optData = [
            //     //         { id: '1', text: 'IT' },
            //     //         { id: '1', text: 'CSE' },
            //     //         { id: '1', text: 'ENTC' },
            //     //         { id: '1', text: 'CIVIL' },
            //     //         { id: '1', text: 'MECH' },
            //     //     ]
            //     //     $('#dept').html('').select2({data: [{id: '', text: ''}]});
            //     //     $('#dept').html('').select2({ data: optData });
            //     // }
            //     var optData = [{ id: '1', text: 'IT' },{ id: '1', text: 'CSE' },{ id: '1', text: 'ENTC' },{ id: '1', text: 'CIVIL' },{ id: '1', text: 'MECH' },];
            //         console.log(optData);
            //     $.ajax({
            //         url: adminUrl+"students/getDepts/",
            //         type: "post",
            //         // data: JSON.stringify(optArr),
            //         data: optArr,
            //         // data: JSON.stringify({ 'id': clg_id, 'val': clg_val }),
            //         // contentType: 'application/json', // Specify content type as JSON
            //         // contentType: "application/json",
            //         success: function (response) {
            //             response = JSON.parse(response);
            //             // response = new Array(response);
            //             // response = JSON.stringify(response);
            //             console.log(response);
            //             $('#dept').html('').select2({data: [{id: '', val: ''}]});
            //             $('#dept').html('').select2({ data: response });
            //         },
            //         error: function (error) {
                    
            //         },
            //     })

            // })
            // $('#createuser').validate();
        })
        function checkPassword() {
            var password = $('#pass').val();
            var p = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            var pattern = new RegExp('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/');
            if (p.test(password)) {
                return true;
            } else {
                alert("Your Password must contain at least one number and one uppercase letter!");
                $('#pass').val("");
                return false;
            }
            console.log("password");
            // return p.test(password);
        }

        function removeBtn(no) {
            if (confirm("are you want to remove this row ? ")) {
                console.log("silfd");
                $('#' + no + '').remove();
                var c = $('#myTable tr').length;
                if (c > 0) {
                    $('#myTable').css('display', 'none');
                }
            }
        }

        function editBtn(no) {
            // $('#'+no+'').remove();
            let nameid = "#name_".concat(no);
            let emailid = "#email_".concat(no);
            // let deptid = "#dept_ids_".concat(no); 
            let deptid = "#dept_values_".concat(no);
            let dobid = "#dob_".concat(no);
            // console.log(emailid);
            // let nameVal = $((emailid)).text()
            console.log(deptid);
            console.log($(deptid).val());

            $('#name').val($((nameid)).text());
            $('#email').val($((emailid)).text());
            // $('#name').val($((deptid)).text());
            $("#dept").select2("val", $(deptid).val());
            $('#dob').val($((dobid)).text());

            $('#add_user').on('click', function () {
                $('#' + no + '').remove();
                $("#dept").select2("val", "saee");
            })

        }

    </script>
</body>

</html>