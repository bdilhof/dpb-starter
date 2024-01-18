import axios from "axios";

// Bootstrap Modules
import "bootstrap/js/dist/dropdown";
import "bootstrap/js/dist/collapse";
import "bootstrap/js/dist/button";
import "bootstrap/js/dist/modal";
import "bootstrap/js/dist/tooltip";

// Axios
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
