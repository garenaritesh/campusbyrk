<?php

include("main_adminpanel.php");

$sql = "select * from complets_train_forms";
$all = mysqli_query($db, $sql);

?>





<!-- Additional Style For Personal Error -->
<style>
    #address_td {
        width: 20%;
    }

    @media print {
        body {
            background: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            border: 1px solid black;
        }

        td {
            border: 1px solid #000;
            width: auto;
            /* padding: 8px; */
        }
    }

    #print_btn {
        position: absolute;
        top: 3%;
        right: 2%;
        font-size: 12px;
        font-weight: 600;
    }

    .panel .right .columns {
        position: absolute;
        top: 3%;
        left: 30%;
    }

    .panel .right .columns p {
        font-size: 12px;
    }


    .panel .right .columns label {
        font-size: 14px;
    }


    table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
    }
</style>






<!-- Title -->
<h4>Records</h4>

<!-- Column Selector -->
<div class="columns">
    <p>Select the columns you want to print, then click "Print Selected".</p>
    <label><input type="checkbox" class="select-column" data-column="1" checked> SrNo</label>
    <label><input type="checkbox" class="select-column" data-column="2" checked> Student Details</label>
    <label><input type="checkbox" class="select-column" data-column="3" checked> From </label>
    <label><input type="checkbox" class="select-column" data-column="4" checked> To</label>
    <label><input type="checkbox" class="select-column" data-column="5" checked> Address</label>
    <label><input type="checkbox" class="select-column" data-column="6" checked> Details</label>
</div>



<!-- Records Print Button  -->
<button id="print_btn" onclick="printSelectedColumns()">Print</button>

<!-- Form Tables -->
<div id="studentTable">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Student Detail</th>
                <th>From</th>
                <th>To</th>
                <th>Address</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($all)) {
                ?>
                <tr>
                    <td><?php echo $row['complete_train_form_id']; ?></td>
                    <td id="std_dtl">Name : <?php echo $row['full_name']; ?> |
                        <?php echo $row['gender']; ?><br>
                        Age : <?php echo $row['age']; ?> year old <br>
                        DOB : <?php echo $row['dob']; ?> <br>
                        Phone : <?php echo $row['phone']; ?><br>
                        <a href="#"></a>
                    </td>
                    <td><?php echo $row['departure']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td id="address_td"><?php echo $row['address']; ?></td>
                    <td><a href="user_form_view.php?viewform=<?php echo $row['complete_train_form_id']; ?>"><i id="more_dtl"
                                class='bx bxs-id-card'></i></a></td>

                </tr>

                <?php
            } ?>
        </tbody>

    </table>
</div>


</div>
<!-- Main Content OF Right Bar -->

</div>


<!-- Javascript file link here -->

<script>
    function printSelectedColumns() {
        // Get all column checkboxes
        const columnCheckboxes = document.querySelectorAll(".select-column");
        const table = document.getElementById("studentTable");
        const allRows = table.querySelectorAll("tr");
        let selectedColumns = [];

        // Determine which columns are selected
        columnCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedColumns.push(parseInt(checkbox.dataset.column));
            }
        });

        if (selectedColumns.length === 0) {
            alert("No columns selected for printing.");
            return;
        }

        // Build the new table content
        let printContent = "<table border='1' cellpadding='0' cellspacing='0'><thead><tr>";
        const headerRow = table.querySelector("thead tr");
        headerRow.querySelectorAll("th").forEach((th, index) => {
            if (selectedColumns.includes(index + 1)) {
                printContent += `<th>${th.innerHTML}</th>`;
            }
        });
        printContent += "</tr></thead><tbody>";

        // Add rows for the selected columns
        allRows.forEach((row, rowIndex) => {
            if (rowIndex === 0) return; // Skip the header row already processed
            let rowContent = "<tr>";
            row.querySelectorAll("td").forEach((td, index) => {
                if (selectedColumns.includes(index + 1)) {
                    rowContent += `<td>${td.innerHTML}</td>`;
                }
            });
            rowContent += "</tr>";
            printContent += rowContent;
        });

        printContent += "</tbody></table>";

        // Open new window for printing
        const printWindow = window.open("", "", "width=1000, height=auto");
        printWindow.document.write(`
            <html>
            <head>
                <title>Print Selected Columns</title>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid #000;
                        padding: 8px;
                        text-align: center;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>
            </head>
            <body>
                ${printContent}
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>

</body>

</html>