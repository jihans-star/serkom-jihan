"use strict";

(function () {
    var sidebarStorageKey = "adminHMD.sidebarMini";
    var themeStorageKey = "adminHMD.colorTheme";
    var desktopMedia = "(min-width: 992px)";

    function onReady(callback) {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", callback);
            return;
        }

        callback();
    }

    function isDesktop() {
        return window.matchMedia(desktopMedia).matches;
    }

    function canUseStorage() {
        try {
            var testKey = sidebarStorageKey + ".test";
            window.localStorage.setItem(testKey, "1");
            window.localStorage.removeItem(testKey);
            return true;
        } catch (error) {
            return false;
        }
    }

    function getSavedMiniState(storageAvailable) {
        if (!storageAvailable) {
            return false;
        }

        return window.localStorage.getItem(sidebarStorageKey) === "true";
    }

    function saveMiniState(storageAvailable, isMini) {
        if (storageAvailable) {
            window.localStorage.setItem(
                sidebarStorageKey,
                String(isMini)
            );
        }
    }

    function getPreferredTheme(storageAvailable) {
        var savedTheme = storageAvailable
            ? window.localStorage.getItem(themeStorageKey)
            : "";

        if (savedTheme === "dark" || savedTheme === "light") {
            return savedTheme;
        }

        if (
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        ) {
            return "dark";
        }

        return "light";
    }

    function saveTheme(storageAvailable, theme) {
        if (storageAvailable) {
            window.localStorage.setItem(themeStorageKey, theme);
        }
    }

    function applyTheme(theme) {
        document.documentElement.setAttribute("data-theme", theme);

        var themeIcons = document.querySelectorAll(
            "[data-theme-icon]"
        );

        Array.prototype.forEach.call(themeIcons, function (icon) {
            if (theme === "dark") {
                icon.classList.remove("bi-moon-stars");
                icon.classList.add("bi-sun");
            } else {
                icon.classList.remove("bi-sun");
                icon.classList.add("bi-moon-stars");
            }
        });

        var themeToggles = document.querySelectorAll(
            "[data-theme-toggle]"
        );

        Array.prototype.forEach.call(themeToggles, function (button) {
            button.setAttribute(
                "aria-label",
                theme === "dark"
                    ? "Switch to light theme"
                    : "Switch to dark theme"
            );

            button.setAttribute(
                "title",
                theme === "dark"
                    ? "Mode terang"
                    : "Mode gelap"
            );
        });
    }

    onReady(function () {
        var body = document.body;
        var sidebarToggle = document.querySelector(
            "[data-sidebar-toggle]"
        );

        var themeToggles = document.querySelectorAll(
            "[data-theme-toggle]"
        );

        var closeButtons = document.querySelectorAll(
            "[data-sidebar-close]"
        );

        var sidebarLinks = document.querySelectorAll(
            ".sidebar-nav .nav-link"
        );

        var mediaQuery = window.matchMedia(desktopMedia);
        var storageAvailable = canUseStorage();

        /* =========================
           THEME
        ========================= */

        var currentTheme = getPreferredTheme(storageAvailable);

        applyTheme(currentTheme);

        Array.prototype.forEach.call(
            themeToggles,
            function (button) {
                button.addEventListener("click", function () {
                    var current =
                        document.documentElement.getAttribute(
                            "data-theme"
                        ) || "light";

                    var nextTheme =
                        current === "dark" ? "light" : "dark";

                    applyTheme(nextTheme);
                    saveTheme(storageAvailable, nextTheme);
                });
            }
        );

        /* =========================
           SIDEBAR
        ========================= */

        function setClass(element, className, enabled) {
            if (enabled) {
                element.classList.add(className);
            } else {
                element.classList.remove(className);
            }
        }

        function setToggleExpanded() {
            var expanded = isDesktop()
                ? !body.classList.contains("sidebar-mini")
                : body.classList.contains("sidebar-open");

            if (sidebarToggle) {
                sidebarToggle.setAttribute(
                    "aria-expanded",
                    String(expanded)
                );
            }
        }

        function closeMobileSidebar() {
            body.classList.remove("sidebar-open");
            setToggleExpanded();
        }

        function toggleSidebar() {
            if (isDesktop()) {
                body.classList.toggle("sidebar-mini");

                saveMiniState(
                    storageAvailable,
                    body.classList.contains("sidebar-mini")
                );
            } else {
                body.classList.toggle("sidebar-open");
            }

            setToggleExpanded();
        }

        function addCloseHandlers(items) {
            Array.prototype.forEach.call(items, function (item) {
                item.addEventListener("click", function () {
                    if (!isDesktop()) {
                        closeMobileSidebar();
                    }
                });
            });
        }

        if (
            getSavedMiniState(storageAvailable) &&
            isDesktop()
        ) {
            body.classList.add("sidebar-mini");
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener(
                "click",
                toggleSidebar
            );
        }

        addCloseHandlers(closeButtons);
        addCloseHandlers(sidebarLinks);

        setToggleExpanded();

        function handleBreakpointChange() {
            if (isDesktop()) {
                body.classList.remove("sidebar-open");

                setClass(
                    body,
                    "sidebar-mini",
                    getSavedMiniState(storageAvailable)
                );
            } else {
                body.classList.remove("sidebar-mini");
            }

            setToggleExpanded();
        }

        if (mediaQuery.addEventListener) {
            mediaQuery.addEventListener(
                "change",
                handleBreakpointChange
            );
        } else if (mediaQuery.addListener) {
            mediaQuery.addListener(
                handleBreakpointChange
            );
        }
    });
})();


/* =========================
   TABLE FILTER
========================= */

document.addEventListener("DOMContentLoaded", function () {

    function setupFilter(
        tableId,
        filters,
        applyId,
        resetId
    ) {
        const table = document.getElementById(tableId);
        const applyButton = document.getElementById(applyId);
        const resetButton = document.getElementById(resetId);

        if (!table || !applyButton || !resetButton) {
            return;
        }

        function filterTable() {
            const rows = table.querySelectorAll(
                "tbody tr"
            );

            rows.forEach(row => {
                const cells = row.querySelectorAll("td");

                if (!cells.length) {
                    return;
                }

                let match = true;

                filters.forEach(filter => {
                    const element =
                        document.getElementById(filter.id);

                    if (!element) {
                        return;
                    }

                    const selected =
                        element.value
                            .trim()
                            .toLowerCase();

                    if (!selected) {
                        return;
                    }

                    const cellValue =
                        cells[filter.column]
                            ?.textContent
                            .trim()
                            .toLowerCase();

                    if (!cellValue.includes(selected)) {
                        match = false;
                    }
                });

                row.style.display = match ? "" : "none";
            });
        }

        applyButton.addEventListener(
            "click",
            filterTable
        );

        resetButton.addEventListener(
            "click",
            function () {
                filters.forEach(filter => {
                    const element =
                        document.getElementById(filter.id);

                    if (element) {
                        element.value = "";
                    }
                });

                filterTable();
            }
        );
    }


    /* =========================
       USER
    ========================= */

    setupFilter(
        "usersTable",
        [
            {
                id: "filterRole",
                column: 2
            },
            {
                id: "filterStatus",
                column: 3
            }
        ],
        "applyFilter",
        "resetFilter"
    );


    /* =========================
       SISWA
    ========================= */

    setupFilter(
        "siswaTable",
        [
            {
                id: "filterSiswaGender",
                column: 2
            },
            {
                id: "filterSiswaTahun",
                column: 3
            }
        ],
        "applySiswaFilter",
        "resetSiswaFilter"
    );


    /* =========================
   PRESTASI
========================= */

    const prestasiTable = document.getElementById("prestasiTable");

    if (prestasiTable) {
        const kategoriFilter = document.getElementById("filterPrestasiKategori");
        const tingkatFilter = document.getElementById("filterPrestasiTingkat");
        const applyFilter = document.getElementById("applyPrestasiFilter");
        const resetFilter = document.getElementById("resetPrestasiFilter");

        if (kategoriFilter && tingkatFilter && applyFilter && resetFilter) {

            function filterPrestasi() {
                const kategori = kategoriFilter.value.trim().toLowerCase();
                const tingkat = tingkatFilter.value.trim().toLowerCase();

                prestasiTable.querySelectorAll("tbody tr").forEach(row => {
                    const cells = row.querySelectorAll("td");

                    if (cells.length < 5) {
                        return;
                    }

                    const textKategoriTingkat = cells[3]
                        ? cells[3].textContent.trim().toLowerCase()
                        : "";

                    // Perbaikan logika Kategori agar "Akademik" tidak menarik "Non Akademik"
                    let kategoriMatch = true;
                    if (kategori) {
                        if (kategori === 'akademik') {
                            kategoriMatch = textKategoriTingkat.includes('akademik') && !textKategoriTingkat.includes('non akademik');
                        } else {
                            kategoriMatch = textKategoriTingkat.includes(kategori);
                        }
                    }

                    const tingkatMatch = !tingkat || textKategoriTingkat.includes(tingkat);

                    row.style.display = (kategoriMatch && tingkatMatch) ? "" : "none";
                });
            }

            applyFilter.addEventListener("click", filterPrestasi);

            resetFilter.addEventListener("click", function () {
                kategoriFilter.value = "";
                tingkatFilter.value = "";
                filterPrestasi();
            });
        }
    }


    /* =========================
       GURU
    ========================= */

    setupFilter(
        "guruTable",
        [
            {
                id: "filterGuruMapel",
                column: 3
            }
        ],
        "applyGuruFilter",
        "resetGuruFilter"
    );


    /* =========================
       GALERI
    ========================= */

    setupFilter(
        "galeriTable",
        [
            {
                id: "filterGaleriKategori",
                column: 2
            }
        ],
        "applyGaleriFilter",
        "resetGaleriFilter"
    );


    /* =========================
       EKSTRAKURIKULER
    ========================= */

    setupFilter(
        "eskulTable",
        [
            {
                id: "filterEkskulPembina",
                column: 3
            }
        ],
        "applyEkskulFilter",
        "resetEkskulFilter"
    );


    /* =========================
        BERITA
    ========================= */

    setupFilter(
        "beritaTable",
        [
            {
                id: "filterBeritaStatus",
                column: 5
            },
            {
                id: "filterBeritaTanggal",
                column: 2
            }
        ],
        "applyBeritaFilter",
        "resetBeritaFilter"
    );

});


/* =========================
   DASHBOARD CHART
========================= */

document.addEventListener(
    "DOMContentLoaded",
    function () {

        const canvas =
            document.getElementById(
                "schoolDataChart"
            );

        if (
            !canvas ||
            typeof Chart === "undefined"
        ) {
            return;
        }

        new Chart(canvas, {

            type: "bar",

            data: {

                labels: [
                    "Siswa",
                    "Guru",
                    "Berita",
                    "Ekskul",
                    "Prestasi",
                    "Galeri",
                    "User"
                ],

                datasets: [{

                    label: "Jumlah Data",

                    data: [
                        Number(canvas.dataset.siswa),
                        Number(canvas.dataset.guru),
                        Number(canvas.dataset.berita),
                        Number(canvas.dataset.ekskul),
                        Number(canvas.dataset.prestasi),
                        Number(canvas.dataset.galeri),
                        Number(canvas.dataset.user)
                    ],

                    borderWidth: 0,
                    borderRadius: 8,
                    maxBarThickness: 45

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        callbacks: {

                            label: function (context) {
                                return (
                                    " " +
                                    context.parsed.y +
                                    " data"
                                );
                            }

                        }

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        },

                        grid: {
                            drawBorder: false
                        }

                    },

                    x: {

                        grid: {
                            display: false
                        }

                    }

                }

            }

        });

    }
);

/* =========================
   TABLE SEARCH
========================= */

document.addEventListener("DOMContentLoaded", function () {
    const searchInputs = document.querySelectorAll("[data-table-search]");

    searchInputs.forEach(function (input) {
        input.addEventListener("input", function () {
            const tableId = input.getAttribute("data-table-search");
            const table = document.getElementById(tableId);

            if (!table) {
                return;
            }

            const keyword = input.value.trim().toLowerCase();
            const rows = table.querySelectorAll("tbody tr");

            rows.forEach(function (row) {
                const cells = row.querySelectorAll("td");

                if (!cells.length) {
                    return;
                }

                const text = row.textContent.toLowerCase();

                row.style.display = text.includes(keyword) ? "" : "none";
            });
        });
    });
});
