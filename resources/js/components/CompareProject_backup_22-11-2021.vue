<template>
<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="main-title text-center" style="margin-top: 10%">
            <h2 class="mt0">Compare Projects</h2>
            <hr class="new5" />
        </div>
    </div>
    <br />
    <div class="panel-group col-md-12" style="margin-bottom: 20px">
        <div class="panel panel-default">
            <div class="panel-header" data-toggle="collapse" href="#searchFilter">
                <div class="panel-heading">
                    <h3 class="panel-title text-white">Search Filters</h3>
                </div>
            </div>
            <div id="searchFilter" class="panel-collapse-body collapse show">
                <div class="col-md-12 display-flex">
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="search_option_two">
                                <div class="candidate_revew_select">
                                    <label class="">Progress</label>
                                    <select v-model="searchFilter.progress" v-on:change="changeProgress()" class="selectpicker w100 show-tick" data-live-search="true" data-live-search-placeholder="Search Progress" multiple>
                                        <option value="Ready for Possession">
                                            Ready for Possession
                                        </option>
                                        <option value="Under Construction">
                                            Under Construction
                                        </option>
                                        <option value="Pre-Live">Pre-Live</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="search_option_two">
                                <div class="candidate_revew_select">
                                    <label class="">Project Types</label>
                                    <select v-model="searchFilter.project_type" v-on:change="changeProjectType()" class="selectpicker w100 show-tick" data-live-search="true" multiple data-live-search-placeholder="Search Project Type">
                                        <!-- multiple -->

                                        <option v-for="(pt, index) in projecttypes" :value="pt">
                                            {{ pt.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="search_option_two">
                                <div class="candidate_revew_select">
                                    <label class="">Area</label>
                                    <select v-model="searchFilter.area" v-on:change="changeArea()" class="selectpicker w100 show-tick" data-live-search="true" multiple data-live-search-placeholder="Search Area">
                                        <!-- multiple -->

                                        <option v-for="(ar, index) in areas" :value="ar">
                                            {{ ar.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <button type="button" id="submitRegisterForm" class="btn btn-thm" style="margin-top: 30px; height: 50%" v-on:click="searchByFilters()">
                            Search
                        </button>
                        <!-- <button
                type="button"
                id="clearFilter"
                class="btn btn-thm"
                style="margin-top: 30px; height: 50%"
                v-on:click="clearSearchFilter()"
              >
                Cancel
              </button> -->
                    </div>
                </div>

                <div class="col-md-12 display-flex" id="frmAddToCompare" v-if="arrProjectsCompare.length < 2">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="search_option_two">
                                <div class="candidate_revew_select">
                                    <label class="">Project <span class="text-red">*</span></label>
                                    <select v-model="newCompareReord.project" v-on:change="changeProject()" class="form-control" data-live-search="true" data-live-search-placeholder="Search Project" required>
                                        <option value="">--Select Project--</option>
                                        <option value="" disabled v-if="filteredProjects.length < 1" class="text-red">
                                            Projects Are Not Found.
                                        </option>
                                        <option v-for="(fp, index) in filteredProjects" :value="fp">
                                            {{ fp.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group" :class="((newCompareReord.project || '') != '' && (newCompareReord.projectUnit || '') == '') ? 'error' : ''">
                            <div class="search_option_two">
                                <div class="candidate_revew_select">
                                    <label class="">Project Units <span class="text-red">*</span></label>
                                    <select v-model="newCompareReord.projectUnit" class="form-control" data-live-search="true" data-live-search-placeholder="Search Project Unit" required>
                                        <option value="">--Select Project Units--</option>
                                        <option value="" disabled class="text-red" v-if="filteredProjectUnits.length < 1">
                                            Project Units Are Not Found.
                                        </option>
                                        <option v-else v-for="(fpu, index) in filteredProjectUnits" :value="fpu">
                                            {{ fpu.title }}
                                        </option>
                                    </select>
                                    <label class="text-red b-600" v-if="(newCompareReord.project || '') != '' && (newCompareReord.projectUnit || '') == ''">Choose the unit</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2" v-if="arrProjectsCompare.length < 2">
                        <button type="button" class="btn btn-log btn-block btn-thm" style="margin-top: 30px" v-on:click="addToCompare">
                            Add To Compare
                        </button>
                    </div>
                </div>
                <!-- <div class="panel-footer">Panel Footer</div> -->
            </div>
        </div>
    </div>
    <div class="col-md-12 compare_table_wrapper_payment display-flex" v-if="arrProjectsCompare.length > 0">
        <!-- <h2>Compare Box</h2><br> -->
        <table class="table table-bordered table-striped compare_tbl_desktop">
            <thead class="compare_table_head">
                <tr>
                    <th scope="col"></th>
                    <th class="compare_table_width" scope="col">Project 1</th>
                    <th class="compare_table_width" scope="col">Project 2</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
                <tr>
                    <th></th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div class="col-md-12 display-flex-wrap">
                            <h4 class="col-md-9 text-right" style="color: #ec1c24; font-weight:600;">{{ pc.name }}</h4>
                            <div class="text-right col-md-3 p-0">
                                <a class="remove-item" data-toggle="tooltip" title="Change Project" v-on:click="deleteCompareProject(pc)" style="background: red;color: white;padding: 6px;cursor:pointer;">
                                    <i style="font-size: 20px" class="fa fa-close red"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <th></th>
                <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                    <div>
                        <div class="comparison-item">
                            <img width="100%" height="100%" :src="'/'+pc.project_cover_img" />
                        </div>
                    </div>
                </td>
                </tr>
                <tr>
                    <th style="color:#54575b !important;">Location</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt" style="color: #ec1c24; font-size:16px;"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;{{ pc.address }}</div>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">
                        Builder</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt">
                            <p v-for="(bldr, index) in pc.owners" style="font-size:15px; color:#54575b !important;">
                                {{ bldr.full_name }}
                            </p>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Project Type</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt" style="font-size:15px; color:#54575b !important; font-weight:400px !important;">
                            {{pc.selectedProjectUnit.type ? pc.selectedProjectUnit.type.title : "--"}}
                        </div>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Status</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div style="font-size:15px; color:#54575b !important;">{{ pc.progress }}</div>
                    </td>
                </tr>

                <!-- <tr>
                    <th>Description</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt" v-html="pc.details"></div>
                    </td>
                </tr> -->

                <!-- <tr>
                    <th>Unit Name</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <h5>{{ pc.selectedProjectUnit.title }}</h5>
                    </td>
                </tr> -->

                <tr>
                    <th style="color:#54575b !important;">Unit Types<span class="text-red">*</span></th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div class="candidate_revew_select_drop">
                            <!-- v-model="pc.selectedProjectUnit" -->
                            <select v-model="pc.selectedProjectUnit" v-on:change="
                    changeCompareProjectUnits(index, pc.selectedProjectUnit)
                  " class="form-control" data-live-search="true" data-live-search-placeholder="Search Project Unit" required>
                                <option disabled class="text-red" v-if="filteredProjectUnits.length < 1">
                                    Project Units Are Not Found.
                                </option>
                                <option v-else v-for="(fpu, index) in pc.units" :value="fpu">
                                    {{ fpu.title }}
                                </option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Price</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <span style="font-size:15px; color:#54575b !important;">{{ Math.floor(pc.selectedProjectUnit.price ? pc.selectedProjectUnit.price : 0).toString() }}</span>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Size</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <span v-if="pc.selectedProjectUnit.covered_area != null">
                            <span style="font-size:15px; color:#54575b !important;">{{parseInt(pc.selectedProjectUnit.covered_area)}}</span>
                            <span style="font-size:15px; color:#54575b !important;">{{pc.selectedProjectUnit.measurement ? pc.selectedProjectUnit.measurement.symbol : "--"}}</span>
                        </span>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Area</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <p v-for="(ar, index) in pc.areas" style="font-size:15px; color:#54575b !important;">
                            {{ ar.name }}
                        </p>
                    </td>
                </tr>

                <!-- <tr>
                    <th>Additional Details</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" :title="(ur.room_type ? ur.room_type.name : '')" v-for="(ur, index) in pc.selectedProjectUnit.unit_rooms">
                            <span v-if="ur.extras != null">
                                <i :class="'fa '+ (ur.room_type ? ur.room_type.icon : '')"></i> :
                                <span>{{ ur.extras ? ur.extras : "" }} </span>
                                <span>{{ur.room_type ? ur.room_type.name : ""}}</span>
                                <br>
                            </span>
                        </a>
                    </td>
                </tr> -->

                <!-- <tr>
                    <th>Bathrooms</th>
                    <td
                    class="compare_table_width"
                    v-for="(pc, index) in arrProjectsCompare"
                    >
                    <span></span>
                    </td>
                </tr> -->

                <tr>
                    <th style="color:#54575b !important;">Monthly Installment</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <!-- <span>{{ pc.selectedProjectUnit.monthly_installment }}</span> -->
                        <span style="font-size:15px; color:#54575b !important;">{{ Math.floor(pc.selectedProjectUnit.monthly_installment ? pc.selectedProjectUnit.monthly_installment : 0).toString() }}</span>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Installment Type</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <span style="font-size:15px; color:#54575b !important;">{{
                pc.selectedProjectUnit.installments
                  ? pc.selectedProjectUnit.installments.name
                  : "--"
              }}</span>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Installment Length</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <span style="font-size:15px; color:#54575b !important;">{{ pc.installment_length }}</span>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Loan Amount</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <!-- <span>{{ pc.selectedProjectUnit.loan_amount }}</span> -->
                        <span style="font-size:15px; color:#54575b !important;">{{ Math.floor(pc.selectedProjectUnit.loan_amount ? pc.selectedProjectUnit.loan_amount : 0).toString() }}</span>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Installment Plan</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <a :href="
                  pc.selectedProjectUnit.payment_plan_img
                    ? '/uploads/project_images/project_' +
                      pc.id +
                      '/unit_' +
                      pc.selectedProjectUnit.id +
                      '/' +
                      pc.selectedProjectUnit.payment_plan_img
                    : ''
                " target="_blank">
                            <img style="height: 300px; width: 450px" :src="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.payment_plan_img
                      : ''
                  " onerror="this.src='/assets/images/not-found.png'" />
                        </a>
                    </td>
                </tr>

                <tr>
                    <th style="color:#54575b !important;">Floor Plan</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <a :href="
                  pc.selectedProjectUnit.payment_plan_img
                    ? '/uploads/project_images/project_' +
                      pc.id +
                      '/unit_' +
                      pc.selectedProjectUnit.id +
                      '/' +
                      pc.selectedProjectUnit.floor_plan_img
                    : ''
                " target="_blank">
                            <img style="height: 300px; width: 450px" :src="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.floor_plan_img
                      : ''
                  " onerror="this.src='/assets/images/not-found.png'" />
                        </a>
                    </td>
                </tr>
                <!-- <tr>
                    <td align="center" class="compare_table_width" :colspan="arrProjectsCompare.length+1">
                        Additional Details
                    </td>
                </tr> -->
                <!-- <tr>
                    <th style="color:#54575b !important;">Facilities</th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div v-if="pc.selectedProjectUnit.unit_rooms.length > 0">
                            <button type="button" class="btn btn-thm col-md-12" data-toggle="collapse" :data-target="'#additional-details-'+pc.selectedProjectUnit.id">Show/Hide</button>
                            <div :id="'additional-details-'+pc.selectedProjectUnit.id" class="collapse show col-md-12 m-t-10">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead style="background-color:#fff; color:#ec1c24;font-size:13px">
                                            <tr>

                                                <th style="background-color:#fff; color:#ec1c24;">
                                                    <span>Facilities</span><br>
                                                </th>
                                                <th>
                                                    <span>Dimensions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="b-600" style="font-size:11px;">
                                            <tr v-for="(rm, index) in pc.selectedProjectUnit.unit_rooms">
                                                <td>
                                                    <span>
                                                        <i :class="'fa '+ (rm.room_type ? rm.room_type.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                                                    </span>
                                                    <span>{{rm.extras ? rm.extras : '0'}}</span>
                                                    <span>{{rm.room_type ? rm.room_type.name : '-'}}</span>
                                                </td>
                                                <td>

                                                    ( <span>{{rm.width_feet ? rm.width_feet : '0'}}.{{rm.width_inches ? rm.width_inches : '0'}}</span>
                                                    <span> x </span>
                                                    <span>{{rm.length_feet ? rm.length_feet : '0'}}.{{rm.length_inches ? rm.length_inches : '0'}}</span> )

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <h3 class="b-600 text-red">N/A</h3>
                        </div>
                    </td>
                </tr> -->
                <tr v-for="(rt, index) in arrRoomTypes">
                    <th style="color:#54575b !important;">
                        <span>
                            <i :class="'fa '+ (rt.icon ? rt.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                        </span>
                        <span>{{rt.name}}</span>
                    </th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div v-if="pc.selectedProjectUnit.unit_rooms.filter(x => x.room_type_id == rt.id).length > 0">
                            <button type="button" class="btn btn-thm col-md-12" data-toggle="collapse" :data-target="'#additional-details-'+pc.selectedProjectUnit.id+'-'+rt.id">
                                <span>
                                    Show/Hide
                                </span>
                                <span class="font-weight:700;">
                                    {{rt.name}}
                                </span>
                            </button>
                            <div :id="'additional-details-'+pc.selectedProjectUnit.id+'-'+rt.id" class="collapse show col-md-12 m-t-10">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead style="background-color:#fff; color:#ec1c24;font-size:13px">
                                            <tr>
                                                <th>{{rt.name}}</th>

                                                <!-- <th style="background-color:#fff; color:#ec1c24;">
                                                    <span>Facilities</span><br>
                                                </th> -->
                                                <th>
                                                    <span>Dimensions</span>
                                                </th>
                                                <!-- <th>Covered Area</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="b-600" style="font-size:11px;">
                                            <tr v-for="(rm, index) in pc.selectedProjectUnit.unit_rooms" v-if="rm.room_type_id == rt.id">
                                                <td>
                                                    <span>{{rm.extras ? rm.extras : '0'}}</span>
                                                </td>
                                                <!-- <td>
                                                    <span>
                                                        <i :class="'fa '+ (rm.room_type ? rm.room_type.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                                                    </span>
                                                    <span>{{rm.extras ? rm.extras : '0'}}</span>
                                                    <span>{{rm.room_type ? rm.room_type.name : '-'}}</span>
                                                </td> -->
                                                <td>

                                                    ( <span>{{rm.width_feet ? rm.width_feet : '0'}}.{{rm.width_inches ? rm.width_inches : '0'}}</span>
                                                    <span> x </span>
                                                    <span>{{rm.length_feet ? rm.length_feet : '0'}}.{{rm.length_inches ? rm.length_inches : '0'}}</span> )

                                                </td>
                                                <!-- <td>{{rm.covered_area ? rm.covered_area + ' SQ.FT' : '-'}}</td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <h4 class="b-600 text-red">NA</h4>
                        </div>
                    </td>
                </tr>

                <!-- <tr>
                    <th>
                        <h4>Bed Rooms</h4>
                    </th>
                    <th>
                        <h4>Dimensions</h4>
                    </th>
                    <th>
                        <h4>Dimensions</h4>
                    </th>

                </tr>
                <tr>
                    <th>
                        <h4>Bed1</h4>
                    </th>
                    <td>
                        12 x 12
                    </td>
                    <td>
                        13 x 13
                    </td>

                </tr>
                <tr>
                    <th>
                        <h4>Bed2</h4>
                    </th>
                    <td>
                        12 x 12
                    </td>
                    <td>
                        13 x 13
                    </td>

                </tr>
                <tr>
                    <th>
                        <h4>Bed3</h4>
                    </th>
                    <td>
                        12 x 12
                    </td>
                    <td>
                        13 x 13
                    </td>

                </tr>

                <tr>
                    <th>
                        <h4>Bath Rooms</h4>
                    </th>
                    <th>
                        <h4></h4>
                    </th>
                    <th>
                        <h4></h4>
                    </th>

                </tr>
                <tr>
                    <th>
                        <h4>Bath1</h4>
                    </th>
                    <td>
                        12 x 12
                    </td>
                    <td>
                        13 x 13
                    </td>

                </tr>
                <tr>
                    <th>
                        <h4>Bath2</h4>
                    </th>
                    <td>
                        12 x 12
                    </td>
                    <td>
                        13 x 13
                    </td>

                </tr>
                <tr>
                    <th>
                        <h4>Bath3</h4>
                    </th>
                    <td>
                        12 x 12
                    </td>
                    <td>
                        13 x 13
                    </td>

                </tr> -->

            </tbody>
        </table>

        <table class="table table-bordered table-striped compare_tbl_mobile" style="width: 100%">
            <thead class="compare_tbl_heading">
                <tr>
                    <th style="width:50%;" scope="col">Project 1</th>
                    <th style="width:50%;" scope="col">Project 2</th>
                </tr>
            </thead>

            <tbody>

                <!-- <tr>
                    <th colspan="2" style="color:#54575b !important;">Project Name</th>
                </tr> -->

                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <div>
                            <h4 style="color: #ec1c24; font-weight:600;">{{ pc.name }}</h4>
                        </div>
                    </td>
                </tr>

                <!-- <tr>
                    <th colspan="2">Project Image</th>
                </tr> -->

                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <div>
                            <div class="text-right" style="margin-bottom: -30px;position: relative;">
                                <a class="remove-item" data-toggle="tooltip" title="Change Project" v-on:click="deleteCompareProject(pc)" style="background: red;color: white;padding: 6px;cursor:pointer;">
                                    <i style="font-size: 20px" class="fa fa-close red"></i>
                                </a>
                            </div>
                            <div class="comparison-item">
                                <img width="100%" height="100%" :src="'/'+pc.project_cover_img" />
                            </div>
                        </div>
                    </td>

                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Location</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt" style="font-size: 17px; color:#ec1c24 !important;"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{ pc.address }}</div>
                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Builder</th>
                </tr>

                <tr>
                    <td style="width:50%;" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt">
                            <p v-for="(bldr, index) in pc.owners" style="font-size: 17px;">
                                {{ bldr.full_name }}
                            </p>
                        </div>

                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Project Type</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt" style="font-size: 17px;">
                            {{pc.selectedProjectUnit.type ? pc.selectedProjectUnit.type.title : "--"}}
                        </div>

                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Status</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <div style="font-size: 17px;">{{ pc.progress }}</div>
                    </td>
                </tr>

                <!-- <tr>
                    <th colspan="2">Description</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <div class="compare_limit_txt" v-html="pc.details"></div>
                    </td>
                </tr> -->

                <!-- <tr>
                    <th colspan="2">Unit Heading</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <h5>{{ pc.selectedProjectUnit.title }}</h5>
                    </td>
                </tr> -->

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Unit Types</th>
                </tr>
                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <div class="candidate_revew_select">
                            <!-- v-model="pc.selectedProjectUnit" -->
                            <select v-model="pc.selectedProjectUnit" v-on:change="
                    changeCompareProjectUnits(index, pc.selectedProjectUnit)
                  " class="form-control" data-live-search="true" data-live-search-placeholder="Search Project Unit" required>
                                <option disabled class="text-red" v-if="filteredProjectUnits.length < 1">
                                    Project Units Are Not Found.
                                </option>
                                <option v-else v-for="(fpu, index) in pc.units" :value="fpu">
                                    {{ fpu.title }}
                                </option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Price</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <!-- <span>{{ pc.selectedProjectUnit.price }}</span> -->
                        <span style="font-size: 17px;">{{ Math.floor(pc.selectedProjectUnit.price ? pc.selectedProjectUnit.price : 0).toString() }}</span>
                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Size</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">

                        <span v-if="pc.selectedProjectUnit.covered_area != null">
                            <span style="font-size: 17px;">{{parseInt(pc.selectedProjectUnit.covered_area)}}</span>
                            <span style="font-size: 17px;">{{pc.selectedProjectUnit.measurement ? pc.selectedProjectUnit.measurement.symbol : "--"}}</span>
                        </span>

                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Area</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">

                        <p v-for="(ar, index) in pc.areas" style="font-size: 17px;">
                            {{ ar.name }}
                        </p>

                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Additional Details</th>
                </tr>

                <tr>

                    <td style="width:50%;" v-for="(pc, index) in arrProjectsCompare">
                        <div style="width: 100%;" v-if="pc.selectedProjectUnit.unit_rooms.length > 0">
                            <button type="button" class="btn btn-thm col-12" data-toggle="collapse" :data-target="'#additional-details-'+pc.selectedProjectUnit.id">Show</button>
                            <div :id="'additional-details-'+pc.selectedProjectUnit.id" class="collapse" style="width: 100%;">
                                <div style="width: 100%;">
                                    <table class="table table-bordered compare_tbl_mobile" style="width: 100%;">
                                        <thead class="" style="width: 50%; background-color:#fff; color:#ec1c24;">
                                            <tr>
                                                <!--  <th>Sr.No</th> -->
                                                <th style="width: 50%; background-color:#fff; color:#ec1c24;">
                                                    <span>Facilities</span><br>
                                                    <span>Dimension</span>
                                                </th>
                                                <!-- <th style="width: 50%;">Covered Area</th> -->
                                            </tr>
                                        </thead>
                                        <tbody style="width: 50%;">

                                            <tr v-for="(rm, index) in pc.selectedProjectUnit.unit_rooms">
                                                <!-- <td>{{index+1}}</td> -->
                                                <td style="width:50%;">
                                                    <span>{{rm.extras ? rm.extras : '0'}}</span> :
                                                    <span>{{rm.room_type ? rm.room_type.name : '-'}}</span> :
                                                    <span>
                                                        <i :class="'fa '+ (rm.room_type ? rm.room_type.icon : '')" style="color:#ec1c2;"></i>
                                                    </span>
                                                    <p>
                                                        <span>{{rm.width_feet ? rm.width_feet : '0'}}.{{rm.width_inches ? rm.width_inches : '0'}}</span>
                                                        <span> x </span>
                                                        <span>{{rm.length_feet ? rm.length_feet : '0'}}.{{rm.length_inches ? rm.length_inches : '0'}}</span>
                                                    </p>
                                                </td>
                                                <!-- <td style="width: 50%;">{{rm.covered_area ? rm.covered_area + ' Sq.Ft' : '-'}}</td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <h4 class="b-600 text-red">N/A</h4>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Monthly Installment</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                        <span style="font-size: 17px;">{{ Math.floor(pc.selectedProjectUnit.monthly_installment ? pc.selectedProjectUnit.monthly_installment : 0).toString() }}</span>
                        <!-- <span>{{ pc.selectedProjectUnit.monthly_installment }}</span> -->
                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Installment Length</th>
                </tr>

                <tr>
                    <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                        <span style="font-size: 17px;">{{ pc.installment_length }}</span>
                    </td>
                </tr>

                <tr>
                    <th colspan="2" style="color:#54575b !important;">Installment Plan</th>
                </tr>
                <tr>
                    <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                        <a :href="
                  pc.selectedProjectUnit.payment_plan_img
                    ? '/uploads/project_images/project_' +
                      pc.id +
                      '/unit_' +
                      pc.selectedProjectUnit.id +
                      '/' +
                      pc.selectedProjectUnit.payment_plan_img
                    : ''
                " target="_blank">
                            <img style="height: 100%; width: 100%;" :src="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.payment_plan_img
                      : ''
                  " onerror="this.src='/assets/images/not-found.png'" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="color:#54575b !important;">Floor Plan</th>
                </tr>
                <tr>
                    <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                        <a :href="
                  pc.selectedProjectUnit.payment_plan_img
                    ? '/uploads/project_images/project_' +
                      pc.id +
                      '/unit_' +
                      pc.selectedProjectUnit.id +
                      '/' +
                      pc.selectedProjectUnit.floor_plan_img
                    : ''
                " target="_blank">
                            <img style="height: 100%; width: 100%" :src="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.floor_plan_img
                      : ''
                  " onerror="this.src='/assets/images/not-found.png'" />
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
</template>

<script>
export default {
    props: ["baseurl", "areas", "projecttypes", "tags", "selectedprojectid"],
    data() {
        return {
            arrArea: [
                // { id: "1", name: "1" },
                // { id: "2", name: "2" },
                // { id: "3", name: "3" },
                // { id: "4", name: "4" },
                // { id: "5", name: "5" },
                // { id: "6", name: "6" },
                // { id: "7", name: "7" },
                // { id: "8", name: "8" },
                // { id: "9", name: "9" },
                // { id: "10", name: "10" },
            ],
            currentCompareProjectIds: [],
            searchFilter: {
                area: [],
                project_type: [],
                progress: [],
            },
            compareProject: {
                projectUnit: {},
            },
            newCompareReord: {
                // project: {},
                // projectUnit: {},
                project: "",
                projectUnit: "",
            },
            filteredProjects: [],
            filteredProjectUnits: [],
            arrProjectsCompare: [],
            arrRoomTypes: [],
            arrDistinctRoomTypes: [],
        };
    },
    created() {
        // console.log("Component Created.");
        // console.log("this.selectedprojectid. -> ", this.selectedprojectid);
        // console.log(
        //   "this.selectedprojectid. -> ",
        //   parseInt(this.selectedprojectid)
        // );
        // console.log(this.areas);
        // console.log(this.projecttypes);
        // console.log(this.tags);
        this.pageLoad();

        // console.log("create_UUID. -> ", create_UUID());

        this.searchByFilters();
    },
    watch: {
        // filteredProjects: function (val) {
        //   this.filteredProjects = val;
        //   alert(JSON.stringify(val));
        // },
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        pageLoad() {
            try {
                // alert(JSON.stringify(this.roleassign));

                // ShowLoader();
                let t = this;
                // axios
                //   .all([
                //     axios.get("/admin/classes/create"),
                //     axios.get("/admin/ddlPeriodCategory"),
                //     axios.get("/getAllSubjects"),
                //     axios.get("/getAllAssignedBranches"),
                //   ])
                //   .then(
                //     axios.spread(function (response, ddlpc, ddlsub, brnch) {
                //       t.records = response.data;
                //       t.ddlPeriodCategory = ddlpc.data;
                //       t.AllActiveSubjects = ddlsub.data;
                //       t.LoginClassAssignedBranches = brnch.data.Branches;
                //       // alert(JSON.stringify(t.LoginClassAssignedBranches));

                //       AttachDatatable();
                //       HideLoader();
                //     }),
                //     (error) => {
                //       HideLoader();
                //       ShowError(error.message);
                //     }
                //   );
            } catch (Err) {
                ShowError(Err);
                HideLoader();
            }
        },
        changeArea() {
            // alert(JSON.stringify(this.searchFilter));
            // axios.patch("/replies/" + this.data.id, {
            //   body: this.body,
            // });
            // this.editing = false;
            // flash("Updated!");
        },
        changeProgress() {},
        changeProjectType() {},

        changeCompareProjectUnits(index, projectUnit) {
            console.log("projectUnit -> New", projectUnit.id);
            // console.log(
            //   "projectUnit -> Old",
            //   this.arrProjectsCompare[index].previousSelectedProjectUnit.id
            // );
            let idsArr = [];
            this.arrProjectsCompare.forEach((value, index) => {
                idsArr.push(value.selectedProjectUnit.id);
                // console.log("forEach -> previousSelectedProjectUnit -> ",value.previousSelectedProjectUnit.id);
            });
            // console.log("forEach -> idsArr -> ", idsArr);
            // console.log(
            //     "condition -> ",
            //     this.arrProjectsCompare.filter((x) => x.selectedProjectUnit.id == projectUnit.id).length
            // );
            if (this.arrProjectsCompare.filter((x) => x.selectedProjectUnit.id == projectUnit.id).length == 2) {
                ShowError("This unit type of this project is already selected.");
                this.arrProjectsCompare[index].selectedProjectUnit = this.arrProjectsCompare[index].previousSelectedProjectUnit;
                // Vue.set(this.arrProjectsCompare, index, this.arrProjectsCompare[index]);
                return;
            } else {
                this.arrProjectsCompare[index].previousSelectedProjectUnit = projectUnit;

                this.arrProjectsCompare[index].selectedProjectUnit = projectUnit;
                // this.arrProjectsCompare[index].selectedProjectUnit.arrUnitRoomTypes = arrUnitRoomTypes;

                // console.log("AAA", JSON.stringify(arrUnitRoomTypes));
                // Vue.set(this.arrProjectsCompare, index, this.arrProjectsCompare[index]);
                // this.arrProjectsCompare[index].selectedProjectUnit.price = projectUnit.price;
                // console.log("selectedProjectUnit -> index -> ", index);
                // console.log(
                //   "selectedProjectUnit -> projectUnit -> ",
                //   JSON.stringify(projectUnit)
                // );
                // console.log(
                //   "this.arrProjectsCompare  -> ",
                //   this.arrProjectsCompare[index].selectedProjectUnit.price
                // );
            }
        },
        addToCompare() {
            if (SubmitForm("frmAddToCompare")) {
                if (
                    this.arrProjectsCompare.filter((x) =>
                        x.id == this.newCompareReord.project.id &&
                        x.selectedProjectUnit.id == this.newCompareReord.projectUnit.id
                    ).length > 0) {
                    ShowError("This project is already exist in compare box.");
                    return;
                }

                let newRecId = create_UUID();
                this.newCompareReord.project.RecId = newRecId;
                this.newCompareReord.project.previousSelectedProjectUnit = this.newCompareReord.projectUnit;
                this.newCompareReord.project.selectedProjectUnit = this.newCompareReord.projectUnit;

                // this.newCompareReord.project.selectedProjectUnit.unitRoomTypes = this.reGenerateRoomTypesWithRooms(this.newCompareReord.project.selectedProjectUnit);

                // console.log("addToCompare() -> this.arrDistinctRoomTypes ", JSON.stringify(this.arrDistinctRoomTypes));
                // console.log("addToCompare() -> this.arrDistinctRoomTypes.length ", JSON.stringify(this.arrDistinctRoomTypes.length));
                // console.log("addToCompare() -> this.newCompareReord.project.selectedProjectUnit/unitRoomTypes ", JSON.stringify(this.newCompareReord.project.selectedProjectUnit.unitRoomTypes));
                // console.log("addToCompare() -> this.newCompareReord.project ", JSON.stringify(this.newCompareReord.project));

                let newProject = JSON.stringify(this.newCompareReord.project);
                // console.log("newProject, -> ", newProject);
                newProject = JSON.parse(newProject);
                this.arrProjectsCompare.push(newProject);
                this.newCompareReord.project = "";
                this.newCompareReord.projectUnit = "";
                let idsArr = [];
                this.arrProjectsCompare.forEach((value, index) => {
                    idsArr.push(value.selectedProjectUnit.id);
                    // console.log("forEach -> previousSelectedProjectUnit -> ",value.previousSelectedProjectUnit.id);
                });
                // console.log("forEach -> idsArr -> ", idsArr);
                this.reGenerateRoomTypesWithRooms();
            }
        },
        deleteCompareProject(Record) {
            // console.log("this.arrProjectsCompare -> ", this.arrProjectsCompare);
            // console.log("Deleted Record -> ", Record);
            this.arrProjectsCompare = this.arrProjectsCompare.filter(
                (x) => x.RecId != Record.RecId
            );
            this.reGenerateRoomTypesWithRooms();
        },
        changeProject() {
            this.filteredProjectUnits = this.newCompareReord.project.units;
            // console.log("this.newCompareReord.project -> ", JSON.stringify(this.newCompareReord.project));
        },
        clearSearchFilter() {
            this.searchFilter = {
                area: [],
                project_type: [],
                progress: [],
            };
            this.searchByFilters();
        },
        searchByFilters() {
            ShowLoader();
            axios.post("/filter-compare-projects", this.searchFilter).then(
                (response) => {
                    try {
                        if (response.data.status) {
                            this.arrRoomTypes = response.data.roomTypes;
                            this.filteredProjects = response.data.data;
                            if (isNormalInteger(this.selectedprojectid)) {
                                console.log("this.selectedprojectid -? ", this.selectedprojectid);
                                let checkProjectisExist = this.filteredProjects.filter(
                                    (x) => x.id == this.selectedprojectid
                                );
                                // console.log("checkProjectisExist -> ", checkProjectisExist.length);
                                if (checkProjectisExist.length > 0) {
                                    // console.log("this.newCompareReord.project -> ", this.newCompareReord.project);
                                    this.newCompareReord.project = checkProjectisExist[0];
                                    this.changeProject();
                                }
                            }

                            HideLoader();
                        } else {
                            ShowError(response.data.message);
                            HideLoader();
                        }
                    } catch (Err) {
                        ShowError(Err);
                        HideLoader();
                    }
                },
                (error) => {
                    ShowError(error.response.data.message);
                    HideLoader();
                }
            );
        },
        reGenerateRoomTypesWithRooms() {
            this.arrDistinctRoomTypes = [];
            this.arrProjectsCompare.forEach(project => {
                let arrUnitRoomTypes = [];
                project.selectedProjectUnit.unit_rooms.forEach(x => {
                    if (this.arrDistinctRoomTypes.filter(y => y.room_type_id == x.room_type_id).length < 1) {
                        this.arrDistinctRoomTypes.push({
                            room_type_id: x.room_type_id,
                            roomTypeName: x.room_type.name,
                            objRoomType: x.room_type
                        });
                        arrUnitRoomTypes.push({
                            room_type_id: x.room_type_id,
                            roomTypeName: x.room_type.name,
                            objRoomType: x.room_type
                        });
                    }
                });
                arrUnitRoomTypes.forEach(x => {
                    let getRooms = project.selectedProjectUnit.unit_rooms.filter(y => y.room_type_id == x.id);
                    x.rooms = getRooms;
                    x.roomCount = getRooms.length;
                });
                project.selectedProjectUnit.unit_rooms_details = arrUnitRoomTypes;

            });

            console.log("reGenerateRoomTypesWithRooms() { -> this.arrDistinctRoomTypes -> length", JSON.stringify(this.arrDistinctRoomTypes.length));
            console.log("reGenerateRoomTypesWithRooms() { -> this.arrDistinctRoomTypes -> ", JSON.stringify(this.arrDistinctRoomTypes));

            console.log("reGenerateRoomTypesWithRooms() { -> this.arrProjectsCompare -> length", JSON.stringify(this.arrProjectsCompare.length));
            console.log("reGenerateRoomTypesWithRooms() { -> this.arrProjectsCompare -> ", JSON.stringify(this.arrProjectsCompare));
        }
    },
};
</script>
