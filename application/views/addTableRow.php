<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Table Row</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <script src='<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 ">
        <input type="hidden" name="baseUrl" id="baseUrl" value="<?= base_url() ?>">
        <input type="hidden" name="count" id="count" value="0">
        <div class="row justify-content-md-center cols-6">
            <table class="table" id="myTable">
                <thead>
                    <th>Name Of Item</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount Of Item</th>
                    <th></th>
                </thead>
                <tbody id="rowBody"></tbody>
                <tfoot id="rowFoot">
                    <tr>
                        <td><b> Total Amount</b></td>
                        <td></td>
                        <td></td>
                        <td id="totalAmt"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <!-- <div class="cols-6">
                <b> Total Amount</b>
            </div> -->
        </div>
        <button class="btn btn-primary mt-4" id="addNewRow" onclick="addNewRow('false')" type="button">Add New
            Row</button>

    </div>
    <!-- <a class="btn btn-primary" href="#" role="button">Link</a>
    <button class="btn btn-primary" type="submit">Button</button>
    <input class="btn btn-primary" type="button" value="Input">
    <input class="btn btn-primary" type="submit" value="Submit">
    <input class="btn btn-primary" type="reset" value="Reset"> -->

    <script>
        const baseUrl = $('#baseUrl').val();
        $(document).ready(function () {

        });
        // function deleteRow(id) { 

        //  }

        function deleteRow(no) {
            if (confirm("are you want to remove this row ? ")) {
                console.log("silfd");
                $('#' + no + '').remove();
                calculateAmt();
                // var c = $('#myTable tr').length;
                // if (c > 0) {
                //     $('#myTable').css('display', 'none');
                // }
            }
        }

        function calculateAmt() {
            // var rowCount = $('#myTable tr').length;
            // var rowCount = $('#myTable >tbody >tr').length;
            // console.log(rowCount, " rowCount ", rowCount);
            // let totalAmt = parseInt(0);
            // for (let i = 0; i < rowCount; i++) {
            //     console.log($('#amt' + i).val(), " ", i, " ");
            //     totalAmt += parseInt($('#amt' + i).val());
            // }
            // console.log(totalAmt);
            // $('#totalAmt').html('');
            // $('#totalAmt').html(totalAmt);


            $('#myTable tbody tr').each(function () {
                // var cellData = $(this).find('td').eq(3).val();
                var cellData = $(this).find('td:eq(3)').text();
                // // var cellid = $(this).find('td:eq(3)').attr('id');
                // var cellId = $(this).find('td:eq(3)').attr('id');
                var cellId = $(this).find('td:eq(1)').attr('id');
                console.log(cellId);
                console.log(cellData);
            });


            var table = $('#myTable')
            table.find('tr').each(function (i, el) {
                var $tds = $(this).find('td'),
                    productId = $tds.eq(0).text(),
                    product = $tds.eq(1).text(),
                    Quantity = $tds.eq(3).text();
                // do something with productId, product, Quantity
            });
        }



        function addNewRow(data1) {
            var formData = new FormData();
            formData.append('val', data1);
            $.ajax({
                url: baseUrl + "Welcome/createLedger",
                type: "Post",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    resData = JSON.parse(res);
                    data = resData.data;
                    // data = {};
                    // console.log(typeof (data), data);
                    // console.log(jQuery.isEmptyObject(data));
                    if (!jQuery.isEmptyObject(data)) {
                        // console.log('luhkb');
                        Object.entries(data).forEach(entry => {
                            // console.log(entry.amt, entry);
                            const [key, data] = entry;
                            // console.log(data);
                            count = $('#count').val();
                            var html = "";
                            html = `<tr id="row${count}"><td><input type="text" class="ledger${count}" id="ledger${count}" value="" ></td><td><input type="number" class="quantity" id="quantity${count}" value="${data.quantity}" ></td><td><input type="number" class="rate" id="rate${count}" value="${data.rate}" ></td><td><input type="number" class="amt" id="amt${count}" data-id="amt${count}" value="${data.amt}" ></td><td><button class="btn btn-danger" id="deleteRow${count}" onclick="deleteRow('row${count}')" ><i class="material-icons" style="font-size:48px;color:red" ></i>delete</button></td></tr>`;
                            $('#rowBody').append(html);
                            var ledgerClass = '.ledger' + count;

                            $('.ledger' + count).append(data.ledger);
                            $('.ledger' + count).select2();
                            count++;
                            $('#count').val(count)
                        });
                    } else {

                        data = {
                            ledger: '<option value="-1" Selected >Select ledger</option>',
                            quantity: 0,
                            rate: "0",
                            amt: "0",
                        };
                        console.log(data, ' sfdh0 ');

                        count = $('#count').val();
                        var html = "";
                        html = `<tr id="row${count}" ><td><input type="text" class="ledger${count}" id="ledger${count}" value="" ></td><td><input type="number" class="quantity" id="quantity${count}" value="${data.quantity}" ></td><td><input type="number" class="rate" id="rate${count}" value="${data.rate}" ></td><td><input type="number" class="amt" id="amt${count}" value="${data.amt}" ></td><td><button class="btn btn-danger" id="deleteRow${count}" onclick="deleteRow('row${count}')" ><i class="material-icons" style="font-size:48px;color:red" ></i>delete</button></td></tr>`;
                        $('#rowBody').append(html);
                        var ledgerClass = '.ledger' + count;

                        $('.ledger' + count).append(data.ledger);
                        $('.ledger' + count).select2();
                        count++;
                        $('#count').val(count)

                    }

                    calculateAmt();

                    // count = $('#count').val();
                    // var html = "";
                    // html = `<tr><td><input type="text" class="ledger${count}" id="ledger${count}" value="" ></td><td><input type="number" class="quantity" id="quantity${count}" value="${quantity}" ></td><td><input type="number" class="rate" id="rate${count}" value="${rate}" ></td><td><input type="number" class="amt" id="amt${count}" value="${amt}" ></td></tr>`;
                    // $('#rowBody').append(html);
                    // var ledgerClass = '.ledger' + count;

                    // $('.ledger' + count).append(data.ledger);
                    // $('.ledger' + count).select2();
                    // count++;
                    // $('#count').val(count)
                    // count1 = $('#count').val();
                    // console.log(count, ' ', count1);

                    // $("#ledger0").select2("val", 5);
                    // $('#ledger0').val('5'); // Select the option with a value of '1'
                    // $('#ledger0').trigger('change');
                    // $('#ledger0').val().trigger('change');
                    // $("#ledger0").val('5').trigger('change');
                }
            })

            // console.log("inside Row ", data1);
            // if (data == null || data == undefined || data == '') {
            //     data = {
            //         ledger: "Select ledger",
            //         quantity: 0,
            //         rate: "0",
            //         amt: "0",
            //     };
            // }
            // count = 0;
            // var html = "";
            // html = `<tr><td><input type="text" class="ledger" id="ledger${count}" value="${data.ledger}" ></td><td><input type="number" class="quantity" id="quantity${count}" value="${data.quantity}" ></td><td><input type="number" class="rate" id="rate${count}" value="${data.rate}" ></td><td><input type="number" class="amt" id="amt${count}" value="${data.amt}" ></td></tr>`;
            // console.log(html);
            // $('#rowBody').append(html);
            // $('#ledger').select2();
        } 
    </script>


</body>

</html>