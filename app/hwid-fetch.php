<?php
include '../includes/misc/autoload.phtml';

set_exception_handler(function ($exception) {
        error_log("\n--------------------------------------------------------------\n");
        error_log($exception);
        error_log("\nRequest data:");
        error_log(print_r($_POST, true));
        error_log("\n--------------------------------------------------------------");
        http_response_code(500);
        die("Error: " . $exception->getMessage());
});

if (session_status() === PHP_SESSION_NONE) {
        session_start();
}

if ($_SESSION['role'] == "Reseller") {
        die("Resellers can't access this.");
}

if (!isset($_SESSION['app'])) {
        dashboard\primary\error("Application not selected");
        die("Application not selected.");
}

if (isset($_POST['draw'])) {

        // credits to https://makitweb.com/datatables-ajax-pagination-with-search-and-sort-php/

        $draw = intval($_POST['draw']);
        $row = intval($_POST['start']);
        $rowperpage = intval($_POST['length']); // Rows display per page
        $columnIndex = misc\etc\sanitize($_POST['order'][0]['column']); // Column index
        $columnName = misc\etc\sanitize($_POST['columns'][$columnIndex]['data']); // Column name
        $columnSortOrder = misc\etc\sanitize($_POST['order'][0]['dir']); // asc or desc
        $searchValue = misc\etc\sanitize($_POST['search']['value']); // Search value

        // whitelist certain column names and sort orders to prevent SQL injection
        if (!in_array($columnName, array("hwid"))) {
                die("Column name is not whitelisted.");
        }

        if (!in_array($columnSortOrder, array("desc", "asc"))) {
                die("Column sort order is not whitelisted.");
        }

        if (!is_null($searchValue)) {
            $query = misc\mysql\query("SELECT * FROM `hwids`");
        }
        else {
            $query = misc\mysql\query("SELECT * FROM `hwids`");
        }

        $data = array();

        while ($row = mysqli_fetch_assoc($query->result)) {

                ## Add Extra Margin to buttons if value is 1 or 2, because datatables with ajax breaks it.
                $MarginManager = "";
                if ($query->num_rows < 2) {
                        $MarginManager = "margin-bottom: 120px;";
                } else {
                        $MarginManager = "margin-bottom: 0px;";
                }

                $data[] = array(
                        "hwid" => '<span class="blur-sm hover:blur-none">' . $row['hwid']. '</span>',
                        "actions" => '<tr><form method="POST">
                        <td>

                        <div x-data="{ open: false }" class="z-0">
                                                <button x-on:click="open = true" class="flex items-center border border-gray-700 rounded-lg focus:opacity-60 text-white focus:text-white font-semibold rounded focus:outline-none focus:shadow-inner py-2 px-4" type="button">
                                                        <span class="mr-1">Actions</span>
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"  style="margin-top:3px">
                                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                                        </svg>
                                                </button>
                                                <ul x-show="open" x-on:click.away="open = false" class="bg-[#09090d] text-white rounded shadow-lg absolute py-2 mt-1" style="min-width:15rem">
                                                        <li>
                                                                <button name="deletehwid" class="block hover:opacity-60 whitespace-no-wrap py-2 px-4 hover:text-red-700"
                                                                value="' . urlencode($row["hwid"]) . '">
                                                                Delete Hwid
                                                                </button>
                                                        </li>
                                                  
                                                     
                                                </ul>
                                                </div>
                        </td>
                </tr>
                    </form>'
                        );
        }

        ## Response
        $response = array(
                "draw" => $draw,
                "aaData" => $data
        );

        die(json_encode($response));
}

die("Request not from datatables, aborted.");
