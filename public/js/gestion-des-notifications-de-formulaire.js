"use strict";

function cacherNotificationApresDelai(span_id, delai) {
    var span_element = document.getElementById(span_id);
    if (span_element) {
        setTimeout(function () {
            span_element.style.display = 'none';
        }, delai);
    }
}