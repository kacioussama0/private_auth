<?php
if (isset($_POST["shop"])) {
   dashboard\primary\error("Coming soon!");
}
?>

<nav class="fixed z-30 w-full bg-[#0f0f17] border-[#09090d]">
    <div class="py-3 px-3 lg:px-5 lg:pl-3">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center">
                <div
                    class="hidden p-2 text-white rounded cursor-pointer lg:inline hover:opacity-60 transition duration-200 -ml-8">
                    <div class="w-6 h-6">
                    </div>
                </div>

                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                    class="p-2 mr-2 text-white rounded cursor-pointer lg:hidden hover:opacity-60 focus:ring-0">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <a href="?page-manage-apps">
                    <img src="https://cdn.discordapp.com/attachments/1163211705719980163/1192618193445978132/SKYLINELOGO1.png?ex=65a9bb3f&is=6597463f&hm=39a110d53b59e7cd1ee1de0429b4f7cc0feca06cd517efa8bd80dc371925a3fe&" alt="Skyline Auth Icon"
                        style="max-width: 100px; height: auto;">
                </a>
            </div>



        </div>
    </div>
</nav>
