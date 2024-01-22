<?php

if ($role == "Manager" && !($permissions & 2)) {
    misc\auditLog\send("Attempted (and failed) to view hwids.");
    dashboard\primary\error("You weren't granted permission to view this page.");
    die();
}
if (!isset($_SESSION['app'])) {
    dashboard\primary\error("Application not selected");
    die("Application not selected.");
}

if (isset($_POST['delhwids'])) {
    $resp = misc\hwid\deleteAll();
    match($resp){
        'failure' => dashboard\primary\error("Failed to delete all hwids!"),
        'success' => dashboard\primary\success("Successfully deleted all hwids!"),
        default => dashboard\primary\error("Unhandled Error! Contact us if you need help")
    };
}

if (isset($_POST['addhwid'])) {
    $resp = misc\hwid\add(urldecode($_POST['hwid']));
    match($resp){
        'already_exist' => dashboard\primary\error("hwid already exists!"),
        'failure' => dashboard\primary\error("Failed to create hwid!"),
        'success' => dashboard\primary\success("Successfully created hwid!"),
        default => dashboard\primary\error("Unhandled Error! Contact us if you need help")
    };
}

if (isset($_POST['deletehwid'])) {
    $resp = misc\hwid\deleteSingular(urldecode($_POST['deletehwid']));
    match ($resp){
        'failure' => dashboard\primary\error("Failed to delete hwid!"),
        'success' => dashboard\primary\success("Successfully deleted hwid!"),
        default => dashboard\primary\error("Unhandled Error! Contact us if you need help")
    };
}


?>






<div class="p-4 bg-[#09090d] block sm:flex items-center justify-between lg:mt-1.5">
    <div class="mb-1 w-full bg-[#0f0f17] rounded-xl">
        <div class="mb-4 p-4">
            <?php require '../app/layout/breadcrumb.php'; ?>
            <h1 class="text-xl font-semibold text-white-900 sm:text-2xl ">Hwids</h1>

            <br>
            <div class="p-4 flex flex-col">
                <div class="overflow-x-auto">
                    <form method="POST">
                        <!-- Hwids Functions -->
                        <button type="button"
                            class="inline-flex text-white bg-purple-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200"
                            data-modal-toggle="create-user-modal" data-modal-target="create-user-modal">
                            <i class="lni lni-circle-plus mr-2 mt-1"></i>Create Hwid
                        </button>

                        <!-- End Hwids Functions -->
                    </form>


                    <!-- Delete Hwids Functions -->
                    <button
                        class="inline-flex text-white bg-red-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200"
                        data-modal-toggle="del-all-users-modal" data-modal-target="del-all-users-modal">
                        <i class="lni lni-trash-can mr-2 mt-1"></i>Delete All Hwids
                    </button>

                    <!-- End Delete Hwids Functions -->

                    <!-- Create Hwid Modal -->
                    <div id="create-user-modal" tabindex="-1" aria-hidden="true"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-[#0f0f17] rounded-lg border border-[#1d4ed8] shadow">
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-white-900">Create Hwid</h3>
                                    <hr class="h-px mb-4 mt-4 bg-gray-700 border-0">
                                    <form class="space-y-6" method="POST">
                                        <div>
                                            <div class="relative mb-4">
                                                <input type="text" id="hwid" name="hwid"
                                                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-white bg-transparent rounded-lg border-1 border-gray-700 appearance-none focus:ring-0  peer"
                                                    placeholder=" " autocomplete="on">
                                                <label for="hwid"
                                                    class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-[#0f0f17] px-2 peer-focus:px-2 peer-focus:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Hwid</label>
                                            </div>


                                        </div>
                                        <button name="addhwid"
                                            class="w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Hwids</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Create User Modal -->

                    <!-- Delete All Users Modal -->
                    <div id="del-all-users-modal" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-[#0f0f17] border border-red-700 rounded-lg shadow">
                                <div class="p-6 text-center">
                                    <div class="flex items-center p-4 mb-4 text-sm text-white border border-yellow-500 rounded-lg bg-[#0f0f17]"
                                        role="alert">
                                        <span class="sr-only">Info</span>
                                        <div>
                                            <span class="font-medium">Notice!</span> You're about to delete all your
                                            hwids. This can not be undone.
                                        </div>
                                    </div>
                                    <h3 class="mb-5 text-lg font-normal text-gray-200">Are you sure you want to delete
                                        all of your hwids?</h3>
                                    <form method="POST">
                                        <button data-modal-hide="del-all-users-modal" name="delhwids"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, I'm sure
                                        </button>
                                        <button data-modal-hide="del-all-users-modal" type="button"
                                            class="inline-flex text-white bg-gray-700 hover:opacity-60 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-200">No,
                                            cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete All Users Modal -->


                    <!-- START TABLE -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-5">
                        <table id="kt_datatable_hwids" class="w-full text-sm text-left text-white">
                            <thead>
                            <tr class="fw-bolder fs-6 px-7">
                                <th class="px-6 py-3">HWID</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
