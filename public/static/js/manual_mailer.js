;(function(window) {
    var
      Mailer = function() {
         console.log("/*/*/*/*/*/*/*/*/*/")
      };

    window.Mailer = new Mailer();
})(this);

;(function($, Mailer) {
    
    Mailer.Mmailer = function() {
        console.log("testing");
    };
    
    return Mailer;
})(jQuery, Mailer || {});