var sikepegawaian = angular.module("sikepegawaian", ["datatables", "chart.js"]);

sikepegawaian.directive("fileInput", [
  "$parse",
  function ($parse) {
    return {
      restrict: "A",
      link: function (scope, elm, attrs) {
        elm.bind("change", function () {
          $parse(attrs.fileInput).assign(scope, elm[0].files);
          scope.$apply();
        });
      },
    };
  },
]);
