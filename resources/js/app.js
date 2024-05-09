/*
 |--------------------------------------------------------------------------
 | Midone Built-in Components
 |--------------------------------------------------------------------------
 |
 | Import Midone built-in components.
 |
 */
import "./bootstrap";
import "@left4code/tw-starter/dist/js/svg-loader";
import "@left4code/tw-starter/dist/js/accordion";
import "@left4code/tw-starter/dist/js/alert";
import "@left4code/tw-starter/dist/js/dropdown";
import "@left4code/tw-starter/dist/js/modal";
import "@left4code/tw-starter/dist/js/tab";

/*
 |--------------------------------------------------------------------------
 | 3rd Party Libraries
 |--------------------------------------------------------------------------
 |
 | Import 3rd party library JS files.
 |
 */
import "./chart";
import "./highlight";
import "./feather";
import "./tiny-slider";
import "./tippy";
import "./datepicker";
import "./tom-select";
import "./dropzone";
import "./validation";
import "./zoom";
import "./notification";
import "./tabulator";
import "./calendar";

/*
 |--------------------------------------------------------------------------
 | Custom Components
 |--------------------------------------------------------------------------
 |
 | Import JS custom components.
 |
 */
// import "./maps";
import "./chat";
import "./show-modal";
import "./show-slide-over";
import "./show-dropdown";
import "./search";
import "./copy-code";
import "./show-code";
import "./side-menu";
import "./mobile-menu";
import "./side-menu-tooltip";
import "./dark-mode-switcher";

`use strict`;
function refreshTime() {
  const timeDisplay = document.getElementById("time");
  const dateString = new Date().toLocaleString();
  const formattedString = dateString.replace(", ", " - ");
  timeDisplay.textContent = formattedString;
}
  setInterval(refreshTime, 1000);

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
