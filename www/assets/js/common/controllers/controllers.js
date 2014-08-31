'use strict';

testApp.controller('ControlPanel', ['$scope', 'Server', '$http', 'API', 'ngTableParams',
    function ($scope, Server, $http, API, ngTableParams) {

        $scope.tableData = [];
        $scope.totalPages = undefined;
        $scope.currentPage = undefined;
        var flag = 0;

        // настройка таблицы
        $scope.tableParams = new ngTableParams({
            page: 1,
            count: 10
        }, {
            counts: [],
            total: $scope.tableData.length
        });

        // загрузка табличных данных
        $scope.getTableData = function () {
            var postRequestData = {
                EducationId: [],
                CitysId: [],
                Page: 1
            };
            if ($scope.educationSelect) {
                $scope.educationSelect.forEach(function (elem) {
                    postRequestData.EducationId.push(elem.Id);
                });
            }
            if ($scope.citySelect) {
                $scope.citySelect.forEach(function (elem) {
                    postRequestData.CitysId.push(elem.Id);
                });
            }
            if ($scope.currentPage) {
                postRequestData.Page = $scope.currentPage;
            }
            if (flag == 1) {
                console.log(flag);
                postRequestData.Page = 1;
                flag = 0;
                console.log(flag);
            }
            var request = Server.POST(API.dataUri, postRequestData);
            request.then(function (response) {
                $scope.tableData = response.Data[0];
                $scope.totalPages = Math.ceil(response.Data[1] / $scope.tableParams.$params.count);
                $scope.currentPage = response.Data[2];
            });
        };
        $scope.getTableData();

        // управление страницами
        $scope.nextPage = function () {
            $scope.currentPage += 1;
            $scope.getTableData();
        };

        $scope.prevPage = function () {
            $scope.currentPage -= 1;
            $scope.getTableData();
        };

        // отображение next/prev
        $scope.noPrev = function () {
            if (($scope.currentPage - 1) == 0) {
                return false;
            } else {
                return true;
            }
        };

        $scope.noNext = function () {
            if ($scope.currentPage == $scope.totalPages) {
                return false;
            } else {
                return true;
            }
        };

        // сортировка по названию
        function sortName(a, b) {
            if (a.Name < b.Name || a.Id == 0)  return -1;
            if (a.Name > b.Name)  return 1;
            return 0;  //если a == b
        }

        $scope.educationSelect = [];
        $scope.educationOptions = [];

        // загрузка образований
        function getEducations() {
            var request = Server.GET(API.educationsUri);
            request.then(function (response) {
                if (response.Code == 200) {
                    $scope.educationOptions = response.Data;
                    $scope.educationOptions.unshift({Id: 0, Name: 'выберите тип образования'});
                    $scope.education = $scope.educationOptions[0];
                }
                else
                    console.log(response.Message)
            });
        }

        getEducations();

        // добавление образования в фильтр
        $scope.addEducation = function () {
            if ($scope.education.Id == 0)
                return;
            $scope.educationSelect.push($scope.education);
            for (var i = 0; i < $scope.educationOptions.length; i++)
                if ($scope.educationOptions[i].Id == $scope.education.Id)
                    $scope.educationOptions.splice(i, 1);
            //
            $scope.education = $scope.educationOptions[0];
            flag = 1;
            console.log($scope.education)
        };

        // удаление образования из фильтра
        $scope.removeEducation = function (value) {
            $scope.educationOptions.push($scope.educationSelect[value]);
            $scope.educationSelect.splice(value, 1);
            //
            $scope.educationOptions.sort(sortName);
            //
            $scope.education = $scope.educationOptions[0];
            flag = 1;
            console.log(value)
        };

        $scope.citySelect = [];
        $scope.cityOptions = [];

        // загрузка образований
        function getCity() {
            var request = Server.GET(API.citiesUri);
            request.then(function (response) {
                if (response.Code == 200) {
                    $scope.cityOptions = response.Data;
                    $scope.cityOptions.unshift({Id: 0, Name: 'выберите город'});
                    $scope.city = $scope.cityOptions[0];
                }
                else
                    console.log(response.Message)
            });
        }

        getCity();

        // добавление образования в фильтр
        $scope.addCity = function () {
            if ($scope.city.Id == 0)
                return;
            $scope.citySelect.push($scope.city);
            for (var i = 0; i < $scope.cityOptions.length; i++)
                if ($scope.cityOptions[i].Id == $scope.city.Id)
                    $scope.cityOptions.splice(i, 1);
            //
            $scope.city = $scope.cityOptions[0];
            flag = 1;
            console.log($scope.city)
        };

        // удаление образования из фильтра
        $scope.removeCity = function (value) {
            $scope.cityOptions.push($scope.citySelect[value]);
            $scope.citySelect.splice(value, 1);
            //
            $scope.cityOptions.sort(sortName);
            //
            $scope.city = $scope.cityOptions[0];
            flag = 1;
            console.log(value)
        };

    }]);
