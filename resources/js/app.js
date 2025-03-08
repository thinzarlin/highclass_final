import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

window.focusTarget = function (name) {
    document.querySelector(name)?.focus();
};

window.selectTarget = function (name) {
    document.querySelector(name)?.select();
};
