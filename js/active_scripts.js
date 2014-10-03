// Associated with replaceSpan
var spanText = {
    // Class (span- will be appended later) : HTML text
    "topSecret": "<abbr title='[REDACTED]'>&#x2588;&#x2588;&#x2588;&#x2588;&#x2588;&#x2588;</abbr>"
};

replaceSpan = function() {
  // This is not a necessary function, delete if necessary.
  for(var key in spanText) {
      if(spanText.hasOwnProperty(key)) {
          $("span .span-" + key).html(spanText.key);
      }
  }
};

$("document").ready(function() {
    replaceSpan();
});