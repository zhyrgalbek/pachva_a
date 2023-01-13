$(document).ready(function() {
    // for Show more, keep location after form submit
    if (window.location.hash == "#more") {
        $(window).scrollTop(sessionStorage.scrollTop);
    }

    $("#detail-filter").submit(function() {
        sessionStorage.scrollTop = window.scrollY;
        startPreloader();
        return true; // return false to cancel form action
    });

    // ckeditor
    var route_prefix = "/filemanager";

    if ($("#editor").length > 0) {
        CKEDITOR.replace("editor", {
            height: 500,
            filebrowserImageBrowseUrl: route_prefix + "?type=Images",
            filebrowserImageUploadUrl:
                route_prefix +
                "/upload?type=Images&_token=" +
                $('meta[name="csrf-token"]').attr("content"),
            filebrowserBrowseUrl: route_prefix + "?type=Files",
            filebrowserUploadUrl:
                route_prefix +
                "/upload?type=Files&_token=" +
                $('meta[name="csrf-token"]').attr("content")
        });
    }

    // marquee string
    $(".marquee")
        .marquee({ duplicated: true, duration: 10000, startVisible: true })
        .mouseover(function() {
            $(this).trigger("pause");
        })
        .mouseout(function() {
            $(this).trigger("resume");
        })
        .mousemove(function(event) {
            if ($(this).data("drag") == true) {
                this.scrollLeft =
                    $(this).data("scrollX") +
                    ($(this).data("x") - event.clientX);
            }
        })
        .mousedown(function(event) {
            $(this)
                .data("drag", true)
                .data("x", event.clientX)
                .data("scrollX", this.scrollLeft);
        })
        .mouseup(function() {
            $(this).data("drag", false);
        });

    // date picker
    var lang = $("html").attr("lang");
    $.datetimepicker.setLocale(lang.replace("ky", "kg"));

    $(".datepicker").datetimepicker({
        timepicker: false,
        mask: "39-19-9999",
        format: "d-m-Y",
        dayOfWeekStart: 1
    });

    $(".datetimepicker").datetimepicker({
        timepicker: true,
        mask: "39-19-9999 29:59",
        format: "d-m-Y H:i",
        dayOfWeekStart: 1
    });

    // list of dependencies
    $("[data-switcher]").change(function() {
        let field = $(this).attr("name");
        let value = $(this).val();
        $("[data-" + field + "]")
            .prop("disabled", true)
            .attr("disabled", "disabled")
            .removeClass("d-none")
            .addClass("d-none");
        $("[data-" + field + '="' + value + '"]')
            .prop("disabled", false)
            .removeAttr("disabled")
            .removeClass("d-none");
    });
    $("[data-switcher]").change();

    // delete symbol "?" if form empty get request
    $("[data-form-nullable]").submit(function() {
        if (!$(this).serialize()) {
            window.location.href = this.action;
            return false;
        }
        return true;
    });
    // dont send field in request, if field value is empty
    $("[data-param]").change(function() {
        if (!!$(this).val()) $(this).attr("name", $(this).data("param"));
        else $(this).removeAttr("name");
    });

    // Confirm Modal

    $("#confirmModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var confirm = button.data("confirm");
        var confirm_text = button.data("confirm-text"); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find("#confirm-text").html(confirm_text);
        modal
            .find("#confirm")
            .off()
            .click(function() {
                window.eval(confirm);
                modal.modal("hide");
            });
    });

    $(".post-show table").wrap('<div class="table-responsive"></div>');

    $('.search-block [data-param="search"]').keyup(function() {
        $(".search-block .search-clear").css("zIndex", (this.value && 3) || -1);
    });

    $(".search-block .search-clear").click(function() {
        $('.search-block [data-param="search"]').val("");
        $(this).css("zIndex", -1);
    });
});

//event preloader-------------------------------------
function startPreloader() {
    $("#layout-preloader").removeClass("d-none");
    $("body").addClass("body-scroll-off");
}

function stopPreloader() {
    $("#layout-preloader").addClass("d-none");
    $("body").removeClass("body-scroll-off");
}
//-----------------------------------------------------

// form validation
(function() {
    "use strict";
    window.addEventListener(
        "load",
        function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            form.classList.add("was-validated");
                        }
                    },
                    false
                );
                form.addEventListener(
                    "reset",
                    function(event) {
                        $(form)
                            .find("input:visible, select:visible")
                            .val("")
                            .trigger("change");
                        event.preventDefault();
                        event.stopPropagation();
                    },
                    false
                );
            });
        },
        false
    );
})();

// tooltip
$(function() {
    $('[data-tooltip="tooltip"]').tooltip({ boundary: "window" });
    $('[data-tooltip="tooltip"]').click(function() {
        $(this).tooltip("hide");
    });
});

// Collapse/Expand
$(function() {
    // Collapse click
    $("[data-toggle=sidebar-colapse], .sidebar-toggle").click(function() {
        SidebarCollapse(this);
    });

    function SidebarCollapse(elem) {
        if (window.innerWidth >= 992) {
            $(".menu-collapsed").toggleClass("d-none");
            $(".sidebar-submenu").toggleClass("d-none");
            $(".fa-caret-down").toggleClass("d-none");
            $(".sidebar-header-logo").toggleClass("d-none");
            $(".sidebar-header-text").toggleClass("d-none");
        }
        $("#sidebar").toggleClass("collapsed");

        // Treating d-flex/d-none on separators with title
        var SeparatorTitle = $(".sidebar-separator-title");
        if (SeparatorTitle.hasClass("d-flex")) {
            SeparatorTitle.removeClass("d-flex");
        } else {
            SeparatorTitle.addClass("d-flex");
        }

        // Collapse/Expand icon
        $("#collapse-icon").toggleClass(
            "fa-angle-double-left fa-angle-double-right"
        );

        if (window.innerWidth >= 992) {
            $('#sidebar:not(.collapsed) [data-tooltip="collapsed"]').tooltip(
                "dispose"
            );
            $('#sidebar.collapsed [data-tooltip="collapsed"]').tooltip({
                boundary: "window"
            });
        }
    }
});

(function() {
    function resizeIFrameToFitContent(iFrame) {
        var cssLink = document.createElement("link");
        cssLink.href = "/css/iframe.css";
        cssLink.rel = "stylesheet";
        cssLink.type = "text/css";
        iFrame.contentWindow.document.head.appendChild(cssLink);
        iFrame.height = iFrame.contentWindow.document.body.offsetHeight + 50;
    }

    window.addEventListener("DOMContentLoaded", function(e) {
        var iFrames = document.getElementsByClassName("height-auto");
        for (var i in iFrames) {
            iFrames[i].onload = function() {
                resizeIFrameToFitContent(this);
            };
        }
        var preloaders = document.querySelectorAll(".preloader");
        for (var i in preloaders || []) {
            if (preloaders[i].dataset) {
                var target =
                    document.querySelector(preloaders[i].dataset.target) || {};
                target.preloader = preloaders[i];
                target.onload = function() {
                    if (this.preloader) {
                        this.preloader.parentElement.removeChild(
                            this.preloader
                        );
                        delete this.preloader;
                    }
                };
            }
        }
    });
})();

//dropdown filter functional
$(function() {
    $("#dropdown-filter .right-carets").on("click", function(e) {
        if ($(document).width() > 768) {
            return false;
        }
        if (
            !$(this)
                .parent()
                .next()
                .hasClass("show")
        ) {
            $(this)
                .parent()
                .parents("#dropdown-filter .dropdown-menu")
                .first()
                .find(".show")
                .removeClass("show");
        }
        var $subMenu = $(this)
            .parent()
            .next("#dropdown-filter .dropdown-menu");
        $subMenu.toggleClass("show");
        $(this)
            .closest("ul")
            .find(".right-carets")
            .not(this)
            .each(function(index, rightCaret) {
                $(rightCaret)
                    .find(".dropdown-rotate-caret")
                    .removeClass("dropdown-rotate-caret");
            });
        $(this)
            .find(".fa-caret-right")
            .toggleClass("dropdown-rotate-caret");

        $(this)
            .parent()
            .parents("#dropdown-filter li.nav-item.dropdown.show")
            .on("hidden.bs.dropdown", function(e) {
                $("#dropdown-filter .dropdown-submenu .show")
                    .closest("li")
                    .find(".right-carets")
                    .not(this)
                    .each(function(index, rightCaret) {
                        $(rightCaret)
                            .find(".dropdown-rotate-caret")
                            .removeClass("dropdown-rotate-caret");
                    });
                $("#dropdown-filter .dropdown-submenu .show").removeClass(
                    "show"
                );
            });
        return false;
    });
    $("#dropdown-filter .filter-event").click(function() {
        $(".hidden-filter-inputs").remove();
        $("#dropdown-filter .dropdown-menu").hide();
        $("#dropdown-btn-text").text($(this).text());
        $("#dropdown-btn-text")
            .next()
            .remove();
        let arrayFilterValues = $(this).data("values");
        let formFilter = $(".for-dropdown-filter").first();
        formFilter.append(
            `<input type="hidden" name="type" value="${arrayFilterValues[0]}"/>`
        );
        if (arrayFilterValues[1] !== undefined)
            formFilter.append(
                `<input type="hidden" name="category" value="${arrayFilterValues[1]}"/>`
            );
        if (arrayFilterValues[2] !== undefined)
            formFilter.append(
                `<input type="hidden" name="kind" value="${arrayFilterValues[2]}"/>`
            );
        startPreloader();
        formFilter.submit();
    });
    $("#filter-clear").click(function() {
        $(".hidden-filter-inputs").remove();
        $("#dropdown-filter .dropdown-menu").hide();
        $("#dropdown-btn-text").text($("#hidden-translation").text());
        $(this).remove();
        startPreloader();
        $(".for-dropdown-filter")
            .first()
            .submit();
    });
});

// Analyses degrees
function getGumusDegreeLabel(num) {
    let result = num != 0 ? `${Math.round(num * 100) / 100}, ` : "—";
    if (num > 0 && num < 1) {
        result += "низкое";
    } else if (num >= 1 && num < 2) {
        result += "ниже среднее";
    } else if (num >= 2 && num < 3) {
        result += "среднее";
    } else if (num >= 3 && num < 10) {
        result += "высокое";
    } else if (num >= 10) {
        result += "очень высокое";
    }

    return result;
}
function getPhDegreeLabel(num) {
    let result = num != 0 ? `${Math.round(num * 100) / 100}, ` : "—";
    if (num > 0 && num < 4.5) {
        result += "сильнокислые";
    } else if (num >= 4.5 && num < 5) {
        result += "среднекислые";
    } else if (num >= 5 && num < 5.5) {
        result += "слабокислые";
    } else if (num >= 5.5 && num < 6) {
        result += "ближе к нейтральным";
    } else if (num >= 6 && num < 8) {
        result += "нейтральные";
    } else if (num >= 8 && num < 8.5) {
        result += "слабощелочные";
    } else if (num >= 8.5 && num < 9) {
        result += "сильнощелочные";
    } else if (num >= 9) {
        result += "очень сильнощелочные";
    }
    return result;
}
function getAzotDegreeLabel(num) {
    let result = num != 0 ? `${Math.round(num * 100) / 100}, ` : "—";
    if (num > 0 && num < 0.12) {
        result += "очень низкое";
    } else if (num >= 0.12 && num < 0.18) {
        result += "низкое";
    } else if (num >= 0.18 && num < 0.26) {
        result += "среднее";
    } else if (num >= 0.26 && num < 0.36) {
        result += "высокое";
    } else if (num >= 0.36) {
        result += "очень высокое";
    }

    return result;
}
function getFosforDegreeLabel(num) {
    let result = num != 0 ? `${Math.round(num * 100) / 100}, ` : "—";
    if (num > 0 && num < 15) {
        result += "очень низкое";
    } else if (num >= 15 && num < 30) {
        result += "низкое";
    } else if (num >= 30 && num < 45) {
        result += "среднее";
    } else if (num >= 45 && num < 60) {
        result += "повышенное";
    } else if (num >= 60) {
        result += "высокое";
    }

    return result;
}
function getKaliyDegreeLabel(num) {
    let result = num != 0 ? `${Math.round(num * 100) / 100}, ` : "—";
    if (num > 0 && num < 100) {
        result += "очень низкое";
    } else if (num >= 100 && num < 200) {
        result += "низкое";
    } else if (num >= 200 && num < 300) {
        result += "среднее";
    } else if (num >= 300 && num < 400) {
        result += "повышенное";
    } else if (num >= 400) {
        result += "высокое";
    }

    return result;
}
function getNatriyDegreeLabel(num) {
    let result = num != 0 ? `${Math.round(num * 100) / 100}, ` : "—";
    if (num > 0 && num < 10) {
        result += "слабая";
    } else if (num >= 10 && num < 15) {
        result += "средняя";
    } else if (num >= 15 && num < 20) {
        result += "сильная";
    } else if (num >= 20) {
        result += "солонцы";
    }

    return result;
}

// Leaflet map
$(document).ready(function() {
    var map = L.map("map", {
        center: [41.2228055, 74.7387787],
        zoom: 7,
        minZoom: 7,
        maxZoom: 14,
        attributionControl: false
    })
        .addLayer(
            new L.TileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png")
        )
        .setMaxBounds(
            L.latLngBounds(L.latLng(44.0, 68.0), L.latLng(39.0, 81.0))
        );

    var markerIcon = L.Icon.extend({
        options: {
            shadowUrl: "/images/marker-shadow.png",
            iconSize: [25, 39],
            shadowSize: [41, 41],
            iconAnchor: [12, 41],
            shadowAnchor: [12, 41],
            popupAnchor: [0, -25]
        }
    });

    var defaultIcon = new markerIcon({ iconUrl: "/images/marker-icon.png" }),
        lowIcon = new markerIcon({ iconUrl: "/images/marker-low.svg" }),
        middleIcon = new markerIcon({ iconUrl: "/images/marker-middle.svg" }),
        highIcon = new markerIcon({ iconUrl: "/images/marker-high.svg" });

    $.get("/js/analysis-data.json", function(data) {
        var coords = [];
        data.forEach(item => {
            var iconType = defaultIcon;
            var markerPopup = "";
            var coordinates =
                item["Широта"] && item["Долгота"]
                    ? [item["Широта"], item["Долгота"]]
                    : [];
            var gumusColumn = "Гумус_%";
            var phColumn = "рН";
            var azotColumn = "Общийазот_%";
            var fosforColumn = "Подвиж_фосфор_мг/кг";
            var kaliyColumn = "Подвиж_калий_мг/кг";
            var natriyColumn = "Солонцеватостьпочв, %";
            var gumusValue = parseFloat(
                item[gumusColumn] ? item[gumusColumn] : 0
            );
            var phValue = parseFloat(item[phColumn] ? item[phColumn] : 0);
            var azotValue = parseFloat(item[azotColumn] ? item[azotColumn] : 0);
            var fosforValue = parseFloat(
                item[fosforColumn] ? item[fosforColumn] : 0
            );
            var kaliyValue = parseFloat(
                item[kaliyColumn] ? item[kaliyColumn] : 0
            );
            var natriyValue = parseFloat(
                item[natriyColumn] ? item[natriyColumn] : 0
            );

            if (coordinates.length === 2 && gumusValue > 0) {
                var gumusDegreeLabel = getGumusDegreeLabel(gumusValue);

                markerPopup += `
                    <b>Гумус:</b> ${gumusDegreeLabel}<br/>
                    <b>pH:</b> ${getPhDegreeLabel(phValue)}<br/>
                    <b>Азот:</b> ${getAzotDegreeLabel(azotValue)}<br/>
                    <b>Фосфор:</b> ${getFosforDegreeLabel(fosforValue)}<br/>
                    <b>Калий:</b> ${getKaliyDegreeLabel(kaliyValue)}<br/>
                    <b>Солонцеватость:</b> ${getNatriyDegreeLabel(
                        natriyValue
                    )}<br/>
                `;

                if (gumusDegreeLabel?.toLowerCase().includes("низкое")) {
                    iconType = lowIcon;
                } else if (
                    gumusDegreeLabel?.toLowerCase().includes("среднее")
                ) {
                    iconType = middleIcon;
                } else if (
                    gumusDegreeLabel?.toLowerCase().includes("высокое")
                ) {
                    iconType = highIcon;
                }

                L.marker(coordinates, { icon: iconType })
                    .bindPopup(markerPopup)
                    .addTo(map);

                // item.coordinates.reverse();
                // var finded = coords.find(c => c.coordinates[0] === item.coordinates[0] && c.coordinates[1] === item.coordinates[1]);
                // if (finded !== undefined) {
                //     finded.items.push(item);
                // } else {
                //     coords.push({
                //         ...item,
                //         items: []
                //     });
                // }
            }
        });

        coords.forEach(item => {
            var iconType = defaultIcon;
            var analysesCount = 1;
            var markerPopup = "";
            var gumusColumn = "гумус, %";
            var phColumn = "pH";
            var azotColumn = "общий азот, %";
            var fosforColumn = "подвижный Фосфор Р2О5, мг/кг почвы";
            var kaliyColumn = "подвижный Калий К2О, мг/кг почвы";
            var natriyColumn = "степень солонцеватости";
            var gumusValue = parseFloat(
                item[gumusColumn] ? item[gumusColumn] : 0
            );
            var phValue = parseFloat(item[phColumn] ? item[phColumn] : 0);
            var azotValue = parseFloat(item[azotColumn] ? item[azotColumn] : 0);
            var fosforValue = parseFloat(
                item[fosforColumn] ? item[fosforColumn] : 0
            );
            var kaliyValue = parseFloat(
                item[kaliyColumn] ? item[kaliyColumn] : 0
            );
            var natriyValue = parseFloat(
                item[natriyColumn] ? item[natriyColumn] : 0
            );

            if (item.items.length > 0) {
                analysesCount += item.items.length;
                item.items.forEach(subItem => {
                    gumusValue += parseFloat(
                        subItem[gumusColumn] ? subItem[gumusColumn] : 0
                    );
                    phValue += parseFloat(
                        subItem[phColumn] ? subItem[phColumn] : 0
                    );
                    azotValue += parseFloat(
                        subItem[azotColumn] ? subItem[azotColumn] : 0
                    );
                    fosforValue += parseFloat(
                        subItem[fosforColumn] ? subItem[fosforColumn] : 0
                    );
                    kaliyValue += parseFloat(
                        subItem[kaliyColumn] ? subItem[kaliyColumn] : 0
                    );
                    natriyValue += parseFloat(
                        subItem[natriyColumn] ? subItem[natriyColumn] : 0
                    );
                });
                gumusValue /= item.items.length;
                phValue /= item.items.length;
                azotValue /= item.items.length;
                fosforValue /= item.items.length;
                kaliyValue /= item.items.length;
                natriyValue /= item.items.length;
            }

            if (item["айылный округ"]) {
                markerPopup += `<b>Айылный округ:</b> ${item["айылный округ"]}<br/>`;
            } else if (item["село"]) {
                markerPopup += `<b>Село:</b> ${item["село"]}<br/>`;
            }

            var gumusDegreeLabel = getGumusDegreeLabel(gumusValue);

            markerPopup += `
                <b>Проведено ${analysesCount} агрохим.анализов:</b><br/>
                <b>Гумус:</b> ${gumusDegreeLabel}<br/>
                <b>pH:</b> ${getPhDegreeLabel(phValue)}<br/>
                <b>Азот:</b> ${getAzotDegreeLabel(azotValue)}<br/>
                <b>Фосфор:</b> ${getFosforDegreeLabel(fosforValue)}<br/>
                <b>Калий:</b> ${getKaliyDegreeLabel(kaliyValue)}<br/>
                <b>Солонцеватость:</b> ${getNatriyDegreeLabel(natriyValue)}<br/>
            `;

            if (gumusDegreeLabel?.toLowerCase().includes("низкое")) {
                iconType = lowIcon;
            } else if (gumusDegreeLabel?.toLowerCase().includes("среднее")) {
                iconType = middleIcon;
            } else if (gumusDegreeLabel?.toLowerCase().includes("высокое")) {
                iconType = highIcon;
            }

            L.marker(item.coordinates, { icon: iconType })
                .bindPopup(markerPopup)
                .addTo(map);
        });
    });
});