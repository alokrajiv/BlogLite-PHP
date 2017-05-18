/*
 * @author Alok Rajiv <mail@alokrajiv.com>
 *
 * ---- LICENSE ----
 * Proprietary License
 * Copyright (C) Convoice Inc. - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */


/* global angular */
var globalPower = {};
(function () {
    'use strict';
    angular
            .module('FeedReaderApp', ['ngMaterial', 'ngSanitize', 'infinite-scroll', 'ngAnimate', 'ui.bootstrap'])

            .directive('myPostRepeatDirective', function () {
                return function ($scope, element, attrs) {
                    var timeCapsule = $(element).find('time.timeago');
                    $scope.$evalAsync(function () {
                        $(timeCapsule[0]).timeago();
                    });
                };
            })

            .controller('ModalDemoCtrl', function ($scope, $uibModal, $log) {

                $scope.items = ['item1', 'item2', 'item3'];
                $scope.animationsEnabled = true;
                $scope.open = function (size, data) {

                    var modalInstance = $uibModal.open({
                        animation: true,
                        templateUrl: 'myModalContent.html',
                        controller: 'ModalInstanceCtrl',
                        size: size,
                        resolve: {
                            items: function () {
                                return data;
                            }
                        }
                    });
                    modalInstance.result.then(function (selectedItem) {
                        $scope.selected = selectedItem;
                    }, function () {
                        $log.info('Modal dismissed at: ' + new Date());
                    });
                };
                $scope.toggleAnimation = function () {
                    $scope.animationsEnabled = !$scope.animationsEnabled;
                };
            })

            .controller('FeedCtrl', function ($http, $scope, $uibModal, $log) {
                var preparedList = [];
                $scope.posts = [];
                $scope.dataLeft = true;
                $scope.apiBusy = false;
                this.initFeed = function () {
                    $scope.posts = [];
                    preparedList = [];
                    post_feed_prepare(function () {
                        $scope.loadMoreData();
                    });
                };
                $scope.loadMoreData = function () {
                    $scope.apiBusy = true;
                    console.log("loafd called");
                    var tmp = [],
                            postsPerLoad = 10;
                    for (var i = 0; i < postsPerLoad; i++) {
                        if (preparedList.length === 0) {
                            console.log("data over");
                            $scope.dataLeft = false;
                            break;
                        }
                        $scope.dataLeft = true;
                        tmp.push(preparedList.pop());
                    }

                    post_fetch_more(tmp, function (data) {
                        $scope.$evalAsync(function () {
                            while (data.length > 0) {
                                $scope.posts.push(data.pop());
                            }
                            $scope.apiBusy = false;
                        });
                        console.log($scope.posts);
                    });
                };
                //this.initFeed();
                var FeedCtrl = this;
                globalPower.remoteFeedReinit = function () {
                    FeedCtrl.initFeed();
                };
                function post_fetch_more(list, cb) {
                    $http({
                        method: 'GET',
                        url: '/api/post/aggregate/',
                        params: {data: list},
                        paramSerializer: '$httpParamSerializerJQLike'
                    }).then(function (response) {
                        //success
                        console.log(response);
                        //preparedList = response.data;
                        if (cb && typeof cb === "function") {
                            cb(response.data);
                        }
                    }, function (response) {
                        //error
                    });
                }

                function post_feed_prepare(cb) {
                    $http({
                        method: 'GET',
                        url: '/api/post/feed/prepare/'
                    }).then(function (response) {
                        //success
                        preparedList = response.data;
                        if (cb && typeof cb === "function") {
                            cb();
                        }
                    }, function (response) {
                        //error
                    });
                }

                $scope.open = function (size, data) {

                    var modalInstance = $uibModal.open({
                        animation: true,
                        templateUrl: 'myModalContent.html',
                        controller: 'ModalInstanceCtrl',
                        size: size,
                        resolve: {
                            data: function () {
                                return data;
                            }
                        }
                    });
                    modalInstance.result.then(function () {

                    }, function () {
                        $log.info('Modal dismissed at: ' + new Date());
                    });
                };

            })

            // Please note that $uibModalInstance represents a modal window (instance) dependency.
            // It is not the same as the $uibModal service used above.

            .controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, data, $sce) {

                $scope.data = data;

                $scope.ok = function () {
                    $uibModalInstance.close();
                };
                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };

                $scope.SkipValidation = function (value) {
                    return $sce.trustAsHtml(value);
                };
            })

            .config(function ($mdThemingProvider) {
                $mdThemingProvider.theme('dark-grey').backgroundPalette('grey').dark();
                $mdThemingProvider.theme('dark-orange').backgroundPalette('orange').dark();
                $mdThemingProvider.theme('dark-purple').backgroundPalette('deep-purple').dark();
                $mdThemingProvider.theme('dark-blue').backgroundPalette('blue').dark();
            });
})();