/**
 * Created by k_shamiev on 10.12.13.
 */
'use strict';

// Declare app level module which depends on filters, and services
var jewerlystyle = angular.module('JewerlyStyle', [
]);

jewerlystyle.controller('TodoCtrl', ['$scope', 'Server', function ($scope, Server) {

    $scope.todos = [
        {text:'learn angular', done:true},
        {text:'build an angular app', done:false},
        {text:'popcorn', done:false},
        {text:'tuzik', done:false}
    ];

    $scope.addTodo = function() {
        // посылаем данные указанной в первом параметре подписке
        Server.SubscribeEvent('EnterListJob', $scope.todoText, "пример передачи дополнительного параметра");

        $scope.todos.push({text:$scope.todoText, done:false});
        $scope.todoText = '';
    };

    $scope.remaining = function() {
        var count = 0;
        angular.forEach($scope.todos, function(todo) {
            count += todo.done ? 0 : 1;
        });
        return count;
    };

    $scope.archive = function() {
        var oldTodos = $scope.todos;
        $scope.todos = [];
        angular.forEach(oldTodos, function(todo) {
            if (!todo.done) $scope.todos.push(todo);
        });
    };
}]);

jewerlystyle.controller('TargetCtrl', ['$scope', 'Server', function ($scope, Server) {

    $scope.color = 'black';

    // создаем подписку с указанным именем и добавляем в ее стек анонимную функцию замыкания (которая срабатывает при посылке данных в нее из любого другого места)
    $scope.controlEnterJob = 'не определено';

    Server.Subscribe('EnterListJob',
        function (job, paramDop) {
            $scope.color = 'red';
            $scope.controlEnterJob = job;
            console.log(job);
        }
    );

    //////////////////////// Другой вариант /////////////////////////////////////////////////////////

    $scope.controlEnterJob2 = 'не определено';

    var zamok = function (job, paramDop) {
        $scope.controlEnterJob2 = paramDop;
    };
    Server.Subscribe('EnterListJob', zamok);


    /*
    Суть в том через замыкание мы связываем нужные объекты и т.д. с данными которые придут по вызову из любого другого места, через указанное именованное событие
     */
}]);
