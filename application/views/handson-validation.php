<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Introduction to Handsontable.js</title>
    <script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" rel="stylesheet"
        media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



    <style>
        /* Center the .ref divs horizontally and vertically */
        .ref {
            margin: 10px;
        }
    </style>
</head>

<body>
    <h1>
        <center>Create your first data-grid</center>
    </h1>

    <div class="ref">
        <input id="search_field" type="search" placeholder="Search">
        <div id="example1" class="hot handsontable htColumnHeaders"></div>
    </div>

    <div class="ref">
        <div class="controls">
            <button id="export-blob">Download CSV</button>
        </div>
    </div>

    <!-- container to wrap the data-grid -->
    <div class="handsontable-container ref"></div>

    <div class="ref">
        <button id="saveData">Save</button>
    </div>

    <script>
        // https://handsontable.com/docs/javascript-data-grid/api/core/?_ga=2.249554375.1104934271.1695966780-1901433678.1695643315#validatecell
        // data for testing : data: Handsontable.helper.createSpreadsheetData(12,5),
        const data = [
            // ['roll','name','stream','semester','email id'],
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
        ]

        let container = document.querySelector('.handsontable-container');
        let hot = new Handsontable(container,
            {
                data: data,      // Initiating handsontable object 
                rowHeaders: true,
                dropdownMenu: true,
                minSpareRows: 1, // it will create a blank row at bottom and when click and hit enter it will keep on creating new rows
                customBorders: true,
                // RemoveRow: true,
                multiColumnSorting: true,
                manualRowMove: true,
                width: 'auto',
                height: 'auto',
                stretchH: 'all', // full size
                contextMenu: true,
                // contextMenu: ['remove_row'],
                search: true,
                bindRowsWithHeaders: 'strict',
                colHeaders: ['roll', 'name', 'stream', 'semester', 'email', 'date', 'company Name'], // custom headers
                filters: true,
                //  validations : https://handsontable.com/docs/javascript-data-grid/cell-validator/
                //  { type: 'numeric', forceNumeric: true, allowEmpty: false, title: 'Your Column Title' },
                //  Add more columns as needed
                columns: [
                    { type: 'numeric', forceNumeric: true, allowEmpty: false,
                        validator(value, callback) {
                            // it will show tha cell value in red
                            if(value > 0 && value < 1000){
                                callback(true);
                            }else{
                                callback(false, 'Invalid value. Value should be between 1 and 1000');
                            }
                        }
                    },
                    {
                        validator(value, callback) {
                            // it will show tha cell value in red
                            if(typeof(value) === 'string'){
                                callback(true);
                            }else{
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
                afterRemoveRow: log.bind(this, 'removeRow'),
                afterChange: function (change, source) {
                    if (source == 'loadData') {
                        return;
                    }
                    change.forEach(function ([row, prop, oldValue, newValue]) {
                        // console.log('Row:', row);
                        // console.log('Property:', prop);
                        // console.log('Old Value:', oldValue);
                        // console.log('New Value:', newValue);
                    });

                },
                beforePaste: function (event, data) {
                    // console.log("before paste", event, data);
                },
                afterPaste: function (event, data) {
                    // console.log("after paste", event, data);
                },
                beforeCopy: function (change, data) {
                    // console.log("Before copy", change, data);
                },
                afterCopy: function (change, data) {
                    // console.log("After copy", change, data);
                },
                afterCreateRow: function (change, data) {
                    // console.log(change, data);
                    // console.log(`${data} row(s) were created, starting at index ${change}`);
                },
                licenseKey: 'non-commercial-and-evaluation', // for non-commercial use only
            })

        // hot.alter('remove_row', 10, 1);

        const button = document.querySelector('#export-blob');
        const exportPlugin = hot.getPlugin('exportFile');

        button.addEventListener('click', () => {
            exportPlugin.downloadFile('csv', {
                bom: false,
                columnDelimiter: ',',
                columnHeaders: false,
                exportHiddenColumns: true,
                exportHiddenRows: true,
                fileExtension: 'csv',
                filename: 'Handsontable-CSV-file_[YYYY]-[MM]-[DD]',
                mimeType: 'text/csv',
                rowDelimiter: '\r\n',
                rowHeaders: true
            });
        });

        function log(el, event) { console.log(el, event) }


        searchFiled = document.getElementById('search_field');

        Handsontable.dom.addEvent(searchFiled, 'keyup', function (event) {
            var search = hot.getPlugin('search');
            var queryResult = search.query(this.value);
            console.log(queryResult);
            hot.render();
        });

        //save data

        let save = document.getElementById("saveData");
        save.addEventListener('click', () => {
            saveFunction();
        });

        function validateAndProcessColumns(columns) {
            return new Promise((resolve, reject) => {
                hot.validateColumns(columns, (valid) => {
                    if (valid) {
                        console.log(data, "sosjrsro");
                        // Validation passed, resolve the promise
                        resolve(true);
                    } else {
                        // Validation failed, reject the promise with an error message
                        // reject("Date must be in September or October of 2023");
                        console.log(data, " ;esjrpe");
                        console.log(columns[0]);
                        // reject();
                        switch(columns[0]){
                            case 0: 
                                console.log('sdfk');
                                reject("Roll No must be in 1 to 1000");
                                // break;
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
                });
            });
        }


        const saveFunction = async () => {
            const data = hot.getData();

            // hot.validateCells((valid) => {
            //     console.log(valid);
            //     if (valid) {
            //         // ... code for validated cells
            //     }
            // })
            // const res = hot.validateColumns([5], (valid) => {
            //     if (valid) {
            //         // ... code for validated columns
            //         return true
            //     }else{
            //         alert("date must be september of oct")
            //         return false
            //     }
            // })

            try {
                // Validate and process columns asynchronously
                for (var i=0; i< data[0].length; i++) {
                        var validationResult = await validateAndProcessColumns([i]);
                        console.log(validationResult);
                }
                // const validationResult = await validateAndProcessColumns([5]);
                // if (validationResult) {
                //     // ... code for validated columns
                // }
            } catch (error) {
                // Validation failed, show an alert with the error message
                alert(error);
                return;
                // Optionally, re-throw the error if you want to handle it at a higher level
                // throw error;
            }

            const url = "<?php echo base_url() . 'index.php/welcome/getData' ?>";
            // Create an object to send data to the server
            const postData = {
                my_data: data, // Replace 'yourDataKey' with the actual key you expect on the server
            };  

            /**
             * Therer are 2 imp functions loadData => hot.loadData(data1)
             * hot.updateSettings({})
             */
            $.ajax({
                url: url,
                method: 'POST', // Use 'method' instead of 'datatype'
                data: JSON.stringify(postData), // Convert postData to a JSON string
                contentType: 'application/json', // Specify content type as JSON
                success: function (res) {
                    let result = JSON.parse(res);
                    //12 rows 5 columns 
                    data1 = Handsontable.helper.createSpreadsheetData(12, 5)
                    // vvimp update data in the table on the go.
                    // var data2 = [
                    //     { id: 1, name: 'John', age: 30 },
                    //     { id: 2, name: 'Jane', age: 25 },
                    //     { id: 3, name: 'Bob', age: 35 },
                    //     // Add more objects as needed
                    // ];
                    // // Update settings data column etc
                    // hot.updateSettings({
                    //     data: data2,
                    //     columns: [
                    //         { data: 'id', title: 'ID' },
                    //         { data: 'name', title: 'Name' },
                    //         { data: 'age', title: 'Age' },
                    //         // Define columns for other properties as needed
                    //     ],
                    // });
                },
                error: function (e) {
                    console.log("Error");
                }
            });
        }

    </script>
</body>

</html>