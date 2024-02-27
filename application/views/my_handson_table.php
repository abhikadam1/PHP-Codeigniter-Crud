<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Handsontable Demo 66468</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/handsontable@8.2.0/dist/handsontable.full.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/handsontable@8.2.0/dist/handsontable.full.min.css" rel="stylesheet"
        media="screen">
    <style>
        .handson {
            margin: 20px;
        }
    </style>
</head>

<body>
    <h1>
        <center>Handsontable Demo</center>
    </h1>
    <div class="handson">
        <input type="search" name="searchBox" id="searchBox" placeholder="search">
        <div id="example1" class="hot handsontable htColumnHeaders"></div>
    </div>
    <div class="handson">
        <button id="downloadfile">Download File</button>
    </div>
    <div class="handson handson-table">

    </div>
    <div class="handson">
        <button id="saveFile">Save File</button>
    </div>

    <script>
        console.log("calling");
        const data = [
            ['Tata', 'Tesla', 'Nissan', 'Toyota', 'Honda', 'Mazda', 'Ford'],
            // ['2017', 10, 11, 12, 13, 15, 16],
            // ['2018', 10, 11, 12, 13, 15, 16],
            // ['2019', 10, 11, 12, 13, 15, 16],
            // ['2020', 10, 11, 12, 13, 15, 16],
            // ['2021', 10, 11, 12, 13, 15, 16],

            [1, 'Raj', 'IT', 8, 'Xyz@email.com', '01/02/2023'],
            [2, 'Timir', 'CSE', 4, 'Xyz@email.com', '01/01/2023'],
            [3, 'Shishir', 'CSE', 5, 'Xyz@email.com', '01/08/2023'],
            [4, 'Arjesh', 'IT', 2, 'Xyz@email.com', '01/03/2023'],
            [5, 'Haris ali', 'IT', 6, 'Xyz@email.com', '01/011/2023'],
            [6, 'Deepak', 'CSE', 4, 'Xyz@email.com', '01/11/2023'],
            [7, 'Dibyendu', 'ECE', 4, 'Xyz@email.com', '01/06/2023'],
            [8, 'Aman', 'IT', 4, 'Xyz@email.com', '01/07/2023'],
            [9, 'Binayak', 'CSE', 6, 'Xyz@email.com', '01/09/2023'],
            [10, 'Harshad', 'ECE', 6, 'Xyz@email.com', '01/04/2023'],
            [11, 'Abhra', 'IT', 4, 'Xyz@email.com', '01/03/2023'],
            [12, 'Sayan', 'IT', 4, 'Xyz@email.com', '01/12/2023'],
        ];
        // let container = document.querySelector('.handson-table');
        let container = $('.handson-table');
        // var ht = new Handsontable(container, data)
        $('.handson-table').handsontable({
            // const hot = new Handsontable(container, {
            data: data,
            // startRows: 5,
            // startCols: 5,
            height: 'auto',
            width: 'auto',
            // colHeaders: true,
            // minSpareRows: 1,
            licenseKey: 'non-commercial-and-evaluation',
            stretchH: 'all',
            search: true,
            dropdownMenu: true,
            // RemoveRow: true,
            contextMenu: true,
            // manualColumnResize: true,
            fillHandle: true,
            filters: true,
            // columnSorting: true,
            // copyPaste: true,
            // undoRedo: true,
            // autoWrapRow: false,
            rowHeaders: true,
            colWidths: 100,

            colHeaders: ['Roll', 'Name', 'Stream', 'Semester', 'Email', 'Date'], // custom headers
            columns: [
                {
                    type: 'numeric', forceNumeric: true, allowEmpty: false,
                    validator(value, callback) {
                        // it will show tha cell value in red
                        if (value > 0 && value < 1000) {
                            callback(true);
                        } else {
                            callback(false, 'Invalid value. Value should be between 1 and 1000');
                        }
                    }
                },
                {
                    validator(value, callback) {
                        // it will show tha cell value in red
                        if (typeof (value) === 'string') {
                            callback(true);
                        } else {
                            callback(false, 'Invalid value. Value should be between 1 and 1000');
                        }
                    }
                },
                { type: "dropdown", source: ['CS', 'IT', 'EXTC', 'CIVIL', 'MECH'] },
                {},
                {},
                {
                    type: 'date',
                    dateFormat: 'DD/MM/YYYY',
                    correctFormat: true,
                    validator(value, callback) {
                        const date = moment(value, 'DD/MM/YYYY');
                        const year = date.year();
                        if (!date.isValid()) {
                            callback(false, 'Invalid date format');
                        } else {
                            const month = date.month() + 1; // Months are zero-indexed in moment.js
                            if (month !== 9 && month !== 10) {
                                callback(false, 'Date must be in September or October');
                                // alert("date must be september of oct")
                            } else {
                                callback(true);
                            }
                        }
                    },
                },
            ],
            beforeInit:function(){
                console.log(" inside beforeInit ");
                return false;
            },

            afterChange: function (change, source) {
                if (source == 'loadData') {
                    return;
                }
                change.forEach(function ([row, prop, oldValue, newValue]) {
                    console.log('Row:', row);
                    console.log('Property:', prop);
                    console.log('Old Value:', oldValue);
                    console.log('New Value:', newValue);
                });

            },
        });
        var hot = $(".handson-table").handsontable('getInstance')

        function log(el, event) { console.log(el, event) };

        searchFiled = document.getElementById('searchBox');
        // searchFiled = $('#searchBox');
        $('#searchBox').on('keyup', function (event) {
            // Handsontable.dom.addEvent(searchFiled, 'keyup', function (event) {
            var search = hot.getPlugin('search');
            var queryResult = search.query(this.value);
            // var queryResult = (hot.getPlugin('search')).query(this.value);
            console.log(queryResult);
            hot.render();
        });

        $('#downloadfile').on('click', function (e) {
            let exportPlugin = hot.getPlugin('exportFile');
            exportPlugin.downloadFile('csv', {
                filename: 'Handsontable-CSV-file_[YYYY]-[MM]-[DD]',
                // bom: false,
                // columnDelimiter: ',',
                // columnHeaders: false,
                // exportHiddenColumns: true,
                // exportHiddenRows: true,
                // fileExtension: 'csv',
                // filename: 'Handsontable-CSV-file_[YYYY]-[MM]-[DD]',
                // mimeType: 'text/csv',
                // rowDelimiter: '\r\n',
                // rowHeaders: true

            });

        })

        $("#saveFile").on("click", function(){
            saveFile();
        })

        const saveFile = async ()=>{
            let dataToSave=JSON.stringify(hot.getData());
            let data = hot.getData();

            try{
                // data[0].forEach((element,index) => {
                //     let valitColumns = await checkValidColumns([index]);
                // });
                for(var i=0; i<data[0].length; i++){
                    let valitColumns = await checkValidColumns([i]);
                }
            }catch(error){
                alert(error);
                console.error();
            }

            const url = "<?= base_url('index.php/user_info/getData') ?>";

            $.ajax({
                type : "POST",
                url  : url,
                data : { dataInfo: data },
                success:function(response){
                    console.log("success");
                    console.log(response);
                },
                error:function(error) {
                    console.log("srkpsor");
                    console.error();
                },
            })
        }

        function checkValidColumns(column){
            return new Promise((resolve,reject)=>{
                hot.validateColumns(column, (valid)=>{
                    if(valid){
                        resolve(true);
                    }else{
                        switch(column[0]){
                            case 0: 
                                reject("Roll No must be in 1 to 1000");
                                break;
                            case 1: 
                                reject('Name must be a string');
                                break;
                            case 2: 
                                reject('Select the appropriate stream');
                                break;
                            case 3: 
                                reject('Write te correct Semester');
                                break;
                            case 4: 
                                reject('Email should be correct');
                                break;
                            case 5: 
                                reject('Date Should in September or October of 2023');
                                break;
                        }
                    }

                })
            })
        }

    </script>
</body>

</html>