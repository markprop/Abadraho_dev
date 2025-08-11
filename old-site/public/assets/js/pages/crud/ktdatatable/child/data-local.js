'use strict';
// Class definition
var KTDatatableChildDataLocalDemo = function() {
	// Private functions

	var subTableInit = function(e) {
		$('<div/>').attr('id', 'child_data_local_' + e.data.RecordID).appendTo(e.detailCell).KTDatatable({
			data: {
				type: 'local',
				source: e.data.Orders,
				pageSize: 5,
			},

			// layout definition
			layout: {
				scroll: true,
				height: 400,
				footer: false,
			},

			sortable: true,

			// columns definition
			columns: [
				{
					field: 'OrderID',
					title: 'Order ID',
					template: function(row) {
						return '<span>' + row.OrderID + ' - ' + row.ShipCountry + '</span>';
					},
				}, {
					field: 'ShipCountry',
					title: 'Country',
					width: 100
				}, {
					field: 'ShipAddress',
					title: 'Ship Address',
				}, {
					field: 'ShipName',
					title: 'Ship Name',
				}, {
					field: 'TotalPayment',
					title: 'Payment',
					type: 'number',
				}, {
					field: 'Status',
					title: 'Status',
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Pending', 'class': 'label-light-primary'},
							2: {'title': 'Delivered', 'class': ' label-light-danger'},
							3: {'title': 'Canceled', 'class': ' label-light-primary'},
							4: {'title': 'Success', 'class': ' label-light-success'},
							5: {'title': 'Info', 'class': ' label-light-info'},
							6: {'title': 'Danger', 'class': ' label-light-danger'},
							7: {'title': 'Warning', 'class': ' label-light-warning'},
						};
						return '<span class="label ' + status[row.Status].class + ' label-inline font-weight-bold label-lg">' + status[row.Status].title + '</span>';
					},
				}, {
					field: 'Type',
					title: 'Type',
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Online', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						return '<span class="label label-' + status[row.Type].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' +
							status[row.Type].state + '">' +
							status[row.Type].title + '</span>';
					},
				}],
		});
	};

	// demo initializer
	var mainTableInit = function() {

		var dataJSONArray = JSON.parse(
			'[{"RecordID":1,"FirstName":"Tommie","LastName":"Pee","Company":"Roodel","Email":"tpee0@slashdot.org","Phone":"103-891-3486","Status":4,"Type":1,"Orders":[{"OrderID":"41250-166","ShipCountry":"FR","ShipAddress":"5 Rutledge Court","ShipName":"Rogahn-Shanahan","OrderDate":"3/7/2017","TotalPayment":"$591994.23","Status":5,"Type":1},{"OrderID":"0078-0595","ShipCountry":"CN","ShipAddress":"953 Schlimgen Park","ShipName":"Hilpert-Sanford","OrderDate":"5/12/2017","TotalPayment":"$79774.93","Status":1,"Type":1},{"OrderID":"47593-443","ShipCountry":"BY","ShipAddress":"46925 Memorial Park","ShipName":"Brakus and Sons","OrderDate":"2/12/2017","TotalPayment":"$1095029.28","Status":1,"Type":1},{"OrderID":"50114-5236","ShipCountry":"NZ","ShipAddress":"1420 Mockingbird Drive","ShipName":"Beer-Harris","OrderDate":"6/6/2017","TotalPayment":"$778690.72","Status":5,"Type":3},{"OrderID":"36987-2826","ShipCountry":"PL","ShipAddress":"3995 Huxley Court","ShipName":"Kling, Miller and Quitzon","OrderDate":"9/1/2017","TotalPayment":"$773995.02","Status":5,"Type":2},{"OrderID":"62750-006","ShipCountry":"ID","ShipAddress":"2064 Dennis Parkway","ShipName":"Lang, Kohler and Considine","OrderDate":"9/21/2017","TotalPayment":"$830550.45","Status":5,"Type":2},{"OrderID":"59779-597","ShipCountry":"IR","ShipAddress":"32 Golf Course Parkway","ShipName":"Jaskolski-Hilll","OrderDate":"4/4/2017","TotalPayment":"$754685.32","Status":3,"Type":3},{"OrderID":"59762-3743","ShipCountry":"HT","ShipAddress":"76 Anthes Hill","ShipName":"Reynolds Group","OrderDate":"1/23/2017","TotalPayment":"$295435.66","Status":2,"Type":1},{"OrderID":"64942-1114","ShipCountry":"ID","ShipAddress":"7511 Mayfield Avenue","ShipName":"Purdy and Sons","OrderDate":"12/1/2016","TotalPayment":"$636911.04","Status":6,"Type":2},{"OrderID":"13537-505","ShipCountry":"KZ","ShipAddress":"36303 Esch Parkway","ShipName":"Reinger, Howe and Kertzmann","OrderDate":"1/31/2016","TotalPayment":"$753691.79","Status":4,"Type":1},{"OrderID":"16781-426","ShipCountry":"SE","ShipAddress":"507 Columbus Lane","ShipName":"Carter, Gibson and Kassulke","OrderDate":"10/26/2017","TotalPayment":"$873190.14","Status":2,"Type":2},{"OrderID":"60512-1008","ShipCountry":"ID","ShipAddress":"8 Jana Lane","ShipName":"Rutherford and Sons","OrderDate":"1/10/2017","TotalPayment":"$242894.68","Status":3,"Type":1},{"OrderID":"0456-0461","ShipCountry":"CN","ShipAddress":"5127 Roxbury Trail","ShipName":"Johnson Inc","OrderDate":"12/10/2017","TotalPayment":"$328850.50","Status":5,"Type":3},{"OrderID":"63304-098","ShipCountry":"GR","ShipAddress":"54627 Randy Lane","ShipName":"Johnston, Veum and Funk","OrderDate":"12/11/2016","TotalPayment":"$278247.03","Status":3,"Type":2},{"OrderID":"64092-317","ShipCountry":"CN","ShipAddress":"292 Rusk Lane","ShipName":"Bode, Zboncak and Reichel","OrderDate":"4/10/2016","TotalPayment":"$798173.38","Status":2,"Type":2},{"OrderID":"36987-1483","ShipCountry":"CU","ShipAddress":"2225 Saint Paul Junction","ShipName":"Dach, Haag and Koss","OrderDate":"2/7/2017","TotalPayment":"$1147799.38","Status":4,"Type":2},{"OrderID":"68084-814","ShipCountry":"ID","ShipAddress":"0 Sheridan Avenue","ShipName":"Little-O\'Hara","OrderDate":"11/24/2016","TotalPayment":"$394051.79","Status":6,"Type":1},{"OrderID":"42023-131","ShipCountry":"BR","ShipAddress":"4238 Roth Drive","ShipName":"Boehm LLC","OrderDate":"4/23/2016","TotalPayment":"$300684.31","Status":6,"Type":3},{"OrderID":"14290-350","ShipCountry":"CN","ShipAddress":"41950 Troy Point","ShipName":"Windler, Larkin and Collier","OrderDate":"4/17/2017","TotalPayment":"$467794.40","Status":4,"Type":1}]},\n' +
			'{"RecordID":2,"FirstName":"Scott","LastName":"Coldbreath","Company":"Zooxo","Email":"scoldbreath1@zdnet.com","Phone":"143-179-5104","Status":5,"Type":1,"Orders":[{"OrderID":"55316-029","ShipCountry":"ID","ShipAddress":"56955 Rusk Street","ShipName":"Paucek, Dietrich and Bergnaum","OrderDate":"9/27/2016","TotalPayment":"$662732.49","Status":2,"Type":3},{"OrderID":"68462-467","ShipCountry":"CN","ShipAddress":"13005 Bultman Court","ShipName":"Stamm Group","OrderDate":"3/22/2017","TotalPayment":"$653958.68","Status":4,"Type":2},{"OrderID":"55154-8270","ShipCountry":"UG","ShipAddress":"6 Brentwood Place","ShipName":"Stroman, Schowalter and Bogan","OrderDate":"8/20/2016","TotalPayment":"$57166.20","Status":3,"Type":2},{"OrderID":"63736-002","ShipCountry":"ID","ShipAddress":"51 Banding Junction","ShipName":"Crona-Konopelski","OrderDate":"2/5/2017","TotalPayment":"$733681.16","Status":3,"Type":2},{"OrderID":"54868-5182","ShipCountry":"CN","ShipAddress":"629 Oxford Alley","ShipName":"Lindgren LLC","OrderDate":"5/21/2016","TotalPayment":"$921137.56","Status":3,"Type":2},{"OrderID":"55714-4529","ShipCountry":"JP","ShipAddress":"9 Melvin Point","ShipName":"Kris-Will","OrderDate":"4/29/2016","TotalPayment":"$184624.81","Status":1,"Type":2},{"OrderID":"63736-305","ShipCountry":"CN","ShipAddress":"84196 New Castle Junction","ShipName":"Lockman-Luettgen","OrderDate":"9/7/2016","TotalPayment":"$922821.30","Status":2,"Type":2}]},\n' +
			'{"RecordID":3,"FirstName":"Flss","LastName":"Thake","Company":"Riffpath","Email":"fthake2@ifeng.com","Phone":"695-591-2075","Status":3,"Type":1,"Orders":[{"OrderID":"0113-0461","ShipCountry":"PS","ShipAddress":"797 Crownhardt Junction","ShipName":"Eichmann and Sons","OrderDate":"3/16/2016","TotalPayment":"$241462.16","Status":2,"Type":3},{"OrderID":"51824-023","ShipCountry":"BR","ShipAddress":"3066 Emmet Drive","ShipName":"Strosin, Lehner and Gislason","OrderDate":"9/17/2016","TotalPayment":"$194555.85","Status":3,"Type":2},{"OrderID":"57520-0221","ShipCountry":"BR","ShipAddress":"2 Havey Trail","ShipName":"Lang, Anderson and Keebler","OrderDate":"6/18/2016","TotalPayment":"$386865.72","Status":2,"Type":1},{"OrderID":"56062-388","ShipCountry":"CN","ShipAddress":"9 Boyd Avenue","ShipName":"Hegmann-Kemmer","OrderDate":"7/1/2016","TotalPayment":"$837648.17","Status":1,"Type":1},{"OrderID":"35356-723","ShipCountry":"UA","ShipAddress":"35 Chive Lane","ShipName":"Konopelski-Cummings","OrderDate":"7/17/2017","TotalPayment":"$730238.90","Status":5,"Type":2},{"OrderID":"35356-491","ShipCountry":"SE","ShipAddress":"6343 Talmadge Street","ShipName":"Wolf Inc","OrderDate":"1/18/2017","TotalPayment":"$777918.32","Status":6,"Type":1},{"OrderID":"76369-4001","ShipCountry":"CN","ShipAddress":"8737 Dunning Plaza","ShipName":"Cruickshank, Gleichner and Gerlach","OrderDate":"9/20/2016","TotalPayment":"$1197505.61","Status":1,"Type":3},{"OrderID":"0378-5042","ShipCountry":"TH","ShipAddress":"1 Old Shore Plaza","ShipName":"Olson-Stark","OrderDate":"8/2/2016","TotalPayment":"$661232.02","Status":5,"Type":2}]},\n' +
			'{"RecordID":4,"FirstName":"Vincents","LastName":"Frearson","Company":"Katz","Email":"vfrearson3@amazon.de","Phone":"197-717-7100","Status":4,"Type":2,"Orders":[{"OrderID":"68084-502","ShipCountry":"BR","ShipAddress":"0814 Briar Crest Plaza","ShipName":"Olson-Connelly","OrderDate":"4/8/2016","TotalPayment":"$494707.94","Status":3,"Type":2},{"OrderID":"76167-002","ShipCountry":"SE","ShipAddress":"7 Quincy Road","ShipName":"Heaney, Lemke and McCullough","OrderDate":"1/10/2017","TotalPayment":"$372281.64","Status":5,"Type":3},{"OrderID":"0517-9702","ShipCountry":"RU","ShipAddress":"948 Granby Lane","ShipName":"Abshire-Cartwright","OrderDate":"1/17/2017","TotalPayment":"$720235.30","Status":1,"Type":1},{"OrderID":"53499-7272","ShipCountry":"UA","ShipAddress":"2553 Ronald Regan Point","ShipName":"Hudson-Breitenberg","OrderDate":"4/29/2017","TotalPayment":"$590146.91","Status":3,"Type":3},{"OrderID":"23155-001","ShipCountry":"ID","ShipAddress":"0237 Larry Park","ShipName":"Fahey, Fritsch and Boyer","OrderDate":"12/7/2016","TotalPayment":"$918885.26","Status":6,"Type":3},{"OrderID":"24909-162","ShipCountry":"AR","ShipAddress":"338 Prentice Road","ShipName":"Yost-Kunde","OrderDate":"4/17/2016","TotalPayment":"$320952.62","Status":6,"Type":3},{"OrderID":"59078-031","ShipCountry":"CN","ShipAddress":"23409 Gale Court","ShipName":"Jenkins-Dickens","OrderDate":"9/28/2016","TotalPayment":"$374124.12","Status":1,"Type":3},{"OrderID":"30142-822","ShipCountry":"VE","ShipAddress":"64 Boyd Center","ShipName":"Bartell Group","OrderDate":"2/12/2016","TotalPayment":"$11592.95","Status":2,"Type":2},{"OrderID":"36987-3147","ShipCountry":"PK","ShipAddress":"66010 Express Pass","ShipName":"Cole, Wilkinson and Macejkovic","OrderDate":"1/28/2016","TotalPayment":"$594910.09","Status":3,"Type":2},{"OrderID":"65841-626","ShipCountry":"PH","ShipAddress":"9 West Way","ShipName":"Batz, Nienow and Spencer","OrderDate":"2/7/2016","TotalPayment":"$742058.75","Status":1,"Type":2},{"OrderID":"57520-0025","ShipCountry":"AU","ShipAddress":"18 Hanover Place","ShipName":"Bode, Upton and Christiansen","OrderDate":"3/28/2016","TotalPayment":"$555669.10","Status":2,"Type":2},{"OrderID":"24236-786","ShipCountry":"BG","ShipAddress":"29471 Kim Alley","ShipName":"Lakin-Murazik","OrderDate":"7/9/2016","TotalPayment":"$164304.08","Status":6,"Type":3}]},\n' +
			'{"RecordID":5,"FirstName":"Antony","LastName":"Stranger","Company":"Tavu","Email":"astranger4@sfgate.com","Phone":"165-466-2893","Status":2,"Type":3,"Orders":[{"OrderID":"53462-175","ShipCountry":"CL","ShipAddress":"6 Spohn Way","ShipName":"O\'Connell Inc","OrderDate":"2/3/2016","TotalPayment":"$749928.82","Status":1,"Type":3},{"OrderID":"53808-0733","ShipCountry":"VN","ShipAddress":"3 Warbler Point","ShipName":"Willms, Glover and O\'Keefe","OrderDate":"5/16/2016","TotalPayment":"$632155.47","Status":1,"Type":1},{"OrderID":"0054-0252","ShipCountry":"CN","ShipAddress":"65 Havey Alley","ShipName":"Deckow, Runolfsson and Kemmer","OrderDate":"4/10/2016","TotalPayment":"$1116585.99","Status":6,"Type":1},{"OrderID":"0093-9660","ShipCountry":"CN","ShipAddress":"2 Maple Drive","ShipName":"Padberg, Powlowski and Brekke","OrderDate":"4/11/2017","TotalPayment":"$513356.12","Status":3,"Type":3},{"OrderID":"63739-047","ShipCountry":"EC","ShipAddress":"0 Talmadge Junction","ShipName":"Rosenbaum-Yundt","OrderDate":"2/19/2016","TotalPayment":"$655497.21","Status":2,"Type":2},{"OrderID":"63323-370","ShipCountry":"ID","ShipAddress":"0 Ramsey Hill","ShipName":"Ankunding, Walsh and Stiedemann","OrderDate":"9/13/2017","TotalPayment":"$380382.26","Status":1,"Type":1},{"OrderID":"57237-040","ShipCountry":"CN","ShipAddress":"945 Golf View Junction","ShipName":"Gulgowski, Feil and Bosco","OrderDate":"2/3/2016","TotalPayment":"$545464.59","Status":3,"Type":1},{"OrderID":"62584-741","ShipCountry":"PY","ShipAddress":"82775 Prairieview Lane","ShipName":"Kihn-Barton","OrderDate":"10/16/2016","TotalPayment":"$571182.87","Status":3,"Type":2},{"OrderID":"0268-0196","ShipCountry":"RU","ShipAddress":"20712 Prentice Terrace","ShipName":"Spencer-Powlowski","OrderDate":"6/7/2017","TotalPayment":"$207925.11","Status":1,"Type":1},{"OrderID":"76214-002","ShipCountry":"US","ShipAddress":"587 Mccormick Parkway","ShipName":"King, O\'Hara and White","OrderDate":"11/14/2016","TotalPayment":"$751439.27","Status":1,"Type":1}]},\n' +
			'{"RecordID":6,"FirstName":"Valaree","LastName":"Keson","Company":"Tagcat","Email":"vkeson5@tamu.edu","Phone":"973-838-6443","Status":5,"Type":1,"Orders":[{"OrderID":"52125-512","ShipCountry":"DO","ShipAddress":"262 Muir Point","ShipName":"Macejkovic Group","OrderDate":"6/15/2017","TotalPayment":"$536675.40","Status":2,"Type":1},{"OrderID":"0832-2012","ShipCountry":"US","ShipAddress":"54258 Westport Center","ShipName":"Walker-Sawayn","OrderDate":"8/19/2016","TotalPayment":"$465873.67","Status":4,"Type":3},{"OrderID":"63187-026","ShipCountry":"YE","ShipAddress":"82133 Holy Cross Court","ShipName":"Harber LLC","OrderDate":"11/4/2016","TotalPayment":"$654402.52","Status":1,"Type":3},{"OrderID":"0591-3292","ShipCountry":"CN","ShipAddress":"68361 Stoughton Park","ShipName":"Armstrong Group","OrderDate":"12/13/2017","TotalPayment":"$1079957.36","Status":1,"Type":1},{"OrderID":"17478-221","ShipCountry":"JP","ShipAddress":"4964 Green Circle","ShipName":"Wuckert-Wiegand","OrderDate":"5/27/2016","TotalPayment":"$1033548.36","Status":5,"Type":2},{"OrderID":"67525-100","ShipCountry":"MA","ShipAddress":"22008 Susan Court","ShipName":"Monahan, Goldner and Ebert","OrderDate":"11/25/2016","TotalPayment":"$1085910.23","Status":2,"Type":3},{"OrderID":"55150-156","ShipCountry":"AR","ShipAddress":"25 Melody Point","ShipName":"Wyman-Rau","OrderDate":"2/8/2017","TotalPayment":"$223935.72","Status":6,"Type":1},{"OrderID":"49349-549","ShipCountry":"CN","ShipAddress":"129 Warner Street","ShipName":"Dietrich-Huel","OrderDate":"5/15/2017","TotalPayment":"$870692.75","Status":3,"Type":3},{"OrderID":"76237-142","ShipCountry":"JP","ShipAddress":"75958 Clyde Gallagher Parkway","ShipName":"Prosacco, Streich and Hyatt","OrderDate":"4/20/2016","TotalPayment":"$431437.76","Status":4,"Type":1},{"OrderID":"42507-668","ShipCountry":"PH","ShipAddress":"25573 La Follette Parkway","ShipName":"Deckow, Green and Larson","OrderDate":"1/26/2017","TotalPayment":"$111453.40","Status":3,"Type":3},{"OrderID":"41520-304","ShipCountry":"CN","ShipAddress":"07 Southridge Pass","ShipName":"Bechtelar Group","OrderDate":"6/25/2016","TotalPayment":"$1164588.04","Status":6,"Type":3},{"OrderID":"0054-0291","ShipCountry":"AR","ShipAddress":"9 Bobwhite Drive","ShipName":"Reichel-Kuhlman","OrderDate":"9/7/2016","TotalPayment":"$864874.30","Status":5,"Type":2},{"OrderID":"53777-001","ShipCountry":"PH","ShipAddress":"9 Spaight Point","ShipName":"Schulist-Fahey","OrderDate":"7/30/2016","TotalPayment":"$893502.67","Status":3,"Type":2}]},\n' +
			'{"RecordID":350,"FirstName":"Teddie","LastName":"Ferneley","Company":"Dabtype","Email":"tferneley9p@oakley.com","Phone":"284-728-5534","Status":6,"Type":2,"Orders":[{"OrderID":"13734-023","ShipCountry":"CN","ShipAddress":"3434 Gulseth Plaza","ShipName":"Hauck LLC","OrderDate":"7/12/2016","TotalPayment":"$707730.01","Status":3,"Type":2},{"OrderID":"64406-008","ShipCountry":"ID","ShipAddress":"4 Boyd Avenue","ShipName":"Dickens-Mann","OrderDate":"7/31/2016","TotalPayment":"$675692.10","Status":1,"Type":3},{"OrderID":"64117-596","ShipCountry":"IR","ShipAddress":"40 Katie Circle","ShipName":"Cremin, D\'Amore and Rowe","OrderDate":"12/4/2017","TotalPayment":"$479956.28","Status":1,"Type":2},{"OrderID":"0591-2784","ShipCountry":"CA","ShipAddress":"42 Sutherland Pass","ShipName":"Hermann-Schroeder","OrderDate":"6/25/2016","TotalPayment":"$242558.93","Status":3,"Type":2},{"OrderID":"55154-4029","ShipCountry":"PT","ShipAddress":"801 Badeau Alley","ShipName":"Cole, King and Crona","OrderDate":"10/12/2017","TotalPayment":"$641687.48","Status":6,"Type":2},{"OrderID":"65862-208","ShipCountry":"ID","ShipAddress":"325 Birchwood Alley","ShipName":"Anderson, Corkery and Gleason","OrderDate":"3/3/2016","TotalPayment":"$1180528.08","Status":5,"Type":3}]}]');

		var datatable = $('#kt_datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'local',
				source: dataJSONArray,
				pageSize: 10, // display 20 records per page
			},

			// layout definition
			layout: {
				scroll: false,
				height: null,
				footer: false,
			},

			sortable: true,

			filterable: false,

			pagination: true,

			detail: {
				title: 'Load sub table',
				content: subTableInit,
			},

			search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},

			// columns definition
			columns: [
				{
					field: 'RecordID',
					title: '',
					sortable: false,
					width: 30,
					textAlign: 'center',
				}, {
					field: 'FirstName',
					title: 'First Name',
				}, {
					field: 'LastName',
					title: 'Last Name',
				}, {
					field: 'Company',
					title: 'Company',
				}, {
					field: 'Email',
					title: 'Email',
				}, {
					field: 'Status',
					title: 'Status',
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Pending', 'class': 'label-primary'},
							2: {'title': 'Delivered', 'class': ' label-danger'},
							3: {'title': 'Canceled', 'class': ' label-primary'},
							4: {'title': 'Success', 'class': ' label-success'},
							5: {'title': 'Info', 'class': ' label-info'},
							6: {'title': 'Danger', 'class': ' label-danger'},
							7: {'title': 'Warning', 'class': ' label-warning'},
						};
						return '<span class="label ' + status[row.Status].class + ' label-inline label-pill">' + status[row.Status].title + '</span>';
					},
				}, {
					field: 'Type',
					title: 'Type',
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Online', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						return '<span class="label label-' + status[row.Type].state + ' label-dot"></span>&nbsp;<span class="font-weight-bold text-' + status[row.Type].state +
							'">' +
							status[row.Type].title + '</span>';
					},
				}, {
					field: 'Actions',
					width: 130,
					title: 'Actions',
					sortable: false,
					overflow: 'visible',
					template: function() {
						return '\
	                        <div class="dropdown dropdown-inline">\
	                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">\
	                                <span class="svg-icon svg-icon-md">\
	                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                            <rect x="0" y="0" width="24" height="24"/>\
	                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>\
	                                        </g>\
	                                    </svg>\
	                                </span>\
	                            </a>\
	                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
	                                <ul class="navi flex-column navi-hover py-2">\
	                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">\
	                                        Choose an action:\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-print"></i></span>\
	                                            <span class="navi-text">Print</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-copy"></i></span>\
	                                            <span class="navi-text">Copy</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-file-excel-o"></i></span>\
	                                            <span class="navi-text">Excel</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-file-text-o"></i></span>\
	                                            <span class="navi-text">CSV</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>\
	                                            <span class="navi-text">PDF</span>\
	                                        </a>\
	                                    </li>\
	                                </ul>\
	                            </div>\
	                        </div>\
	                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                        <rect x="0" y="0" width="24" height="24"/>\
	                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
	                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
	                                    </g>\
	                                </svg>\
	                            </span>\
	                        </a>\
	                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                        <rect x="0" y="0" width="24" height="24"/>\
	                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
	                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
	                                    </g>\
	                                </svg>\
	                            </span>\
	                        </a>\
	                    ';
					},
				}],
		});

		$('#kt_datatable_search_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});

		$('#kt_datatable_search_type').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
	};

	return {
		// Public functions
		init: function() {
			// init dmeo
			mainTableInit();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableChildDataLocalDemo.init();
});
