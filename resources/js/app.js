import './bootstrap';

import Alpine from 'alpinejs';

$(document).ready(function(){
    setTimeout(function()  {
        $(".flashmessage").slideUp("slow");
    }, 3000);
})
window.Alpine = Alpine;

Alpine.start();




