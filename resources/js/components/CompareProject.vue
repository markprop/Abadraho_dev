

<template>
    <div class="container">

  <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb0-991">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active text-thm" aria-current="page">Compare</li>
                        </ol>
                        <h2 class="breadcrumb_title">Compare</h2>
                    </div>
                </div>
            </div>

        <div class="row mb50">
            <div class="col-md-12 display-flex bg-white pt-4 ">
                <div class="col-md-4 filter-pading">
                    <div class="form-group">
                        <div class="search_option_two">
                            <div class="candidate_revew_select">
                                <select class="select2-progress compare-opt"  v-model="searchFilter.progress" @change="searchByFilters()"
                                         multiple="multiple">
                                    <option value="Ready for Possessions">
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
                <div class="col-md-4 filter-pading">
                    <div class="form-group">
                        <div class="search_option_two">
                            <div class="candidate_revew_select">
                                <select v-model="searchFilter.project_type" @change="searchByFilters()"
                                        class="select2-project-type" data-live-search="true" multiple
                                        data-live-search-placeholder="Search Project Type">
                                    <!-- multiple -->

                                    <option v-for="(pt, index) in projecttypes" :value="pt">
                                        {{ pt.title }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 filter-pading">
                    <div class="form-group">
                        <div class="search_option_two">
                            <div class="candidate_revew_select">
                                <select v-model="searchFilter.area" @change="searchByFilters()"
                                        class="select2-area" data-live-search="true" multiple
                                        data-live-search-placeholder="Search Area">
                                    <!-- multiple -->

                                    <option v-for="(ar, index) in areas" :value="ar">
                                        {{ ar.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 display-flex bg-white pb-4" id="frmAddToCompare">
                <div class="col-md-4 filter-pading">
                    <div class="form-group">
                        <div class="search_option_two">
                            <div class="candidate_revew_select">
                                <select v-model="newCompareReord.project" v-on:change="changeProject()"
                                        class="form-control" data-live-search="true"
                                        data-live-search-placeholder="Search Project" required>
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
                <div class="col-md-4 filter-pading">
                    <div class="form-group"
                         :class="((newCompareReord.project || '') != '' && (newCompareReord.projectUnit || '') == '') ? 'error' : ''">
                        <div class="search_option_two">
                            <div class="candidate_revew_select">
                                <select v-model="newCompareReord.projectUnit" class="form-control"
                                        data-live-search="true" data-live-search-placeholder="Search Project Unit"
                                        required>
                                    <option value="">--Select Project Units--</option>
                                    <option value="" disabled class="text-red" v-if="filteredProjectUnits.length < 1">
                                        Project Units Are Not Found.
                                    </option>
                                    <option v-else v-for="(fpu, index) in filteredProjectUnits" :value="fpu">
                                        {{ fpu.title }}
                                    </option>
                                </select>
                                <label class="text-red b-600"
                                       v-if="(newCompareReord.project || '') != '' && (newCompareReord.projectUnit || '') == ''">Choose
                                    the unit</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 filter-pading">
                    <button type="button" class="btn btn-log btn-block btn-thm" @click="addToCompare">
                        Add To Compare
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 compare_table_wrapper_payment display-flex p0" v-if="arrProjectsCompare.length > 0">
                <!-- <h2>Compare Box</h2><br> -->
                <table class="table table-responsive table-bordered table-striped compare_tbl_desktop">
                    <thead class="compare_table_head">
<!--                    <tr>-->
<!--                        <th scope="col"></th>-->
<!--                        <th class="compare_table_width" scope="col">Project 1</th>-->
<!--                        <th class="compare_table_width" scope="col">Project 2</th>-->
<!--                    </tr>-->
                    <tr>
                        <th></th>
                        <th class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                            <div class="col-md-12 display-flex-wrap">
                                <h4 class="col-md-8 text-right">
                                    <a :href="'/project/'+pc.slug" target="_blank"
                                       style="color: #ffffff; font-weight:600;text-decoration:underline;">
                                        {{ pc.name }}
                                    </a>
                                </h4>
                                <div class="text-right col-md-4 p-0">
                                    <a class="remove-item" data-toggle="tooltip" title="Change Project"
                                       v-on:click="deleteCompareProject(pc)"
                                       style="background: red;color: white;padding: 6px;cursor:pointer;">
                                        <i style="font-size: 20px" class="fa fa-close red"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <th></th>
                    <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <div>
                            <div class="comparison-item">
                                <img width="100%" height="100%" :src="'/'+pc.project_cover_img"/>
                            </div>
                        </div>
                    </td>
                    </tr>
                    <tr>
                        <th style="color:#54575b !important;">Location</th>
                        <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                            <div class="compare_limit_txt" style="color: #ec1c24; font-size:16px;"><i
                                class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;{{ pc.address }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th style="color:#54575b !important;">
                            Builder
                        </th>
                        <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                            <div class="compare_limit_txt">
                                <p v-for="(bldr, index) in pc.owners" style="font-size:15px; color:#54575b !important;">
                                    {{ bldr.full_name }}
                                </p>
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
                        <th style="color:#54575b !important;">Projet Unit <span class="text-red">*</span></th>
                        <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                            <div class="candidate_revew_select_drop">
                                <!-- v-model="pc.selectedProjectUnit" -->
                                <select v-model="pc.selectedProjectUnitId"
                                        v-on:change="changeCompareProjectUnits(index, pc)" class="form-control"
                                        placeholder="Search Project Unit" required>
                                    <option disabled class="text-red" v-if="pc.units.length < 1">
                                        Project Units Are Not Found.
                                    </option>
                                    <option v-else v-for="(fpu, index) in pc.units" :value="fpu.id">
                                        {{ fpu.title }}
                                    </option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="color:#54575b !important;">Unit Type</th>
                        <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                            <div class="compare_limit_txt"
                                 style="font-size:15px; color:#54575b !important; font-weight:400px !important;">
                                {{ pc.selectedProjectUnit.type ? pc.selectedProjectUnit.type.title : "--" }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="color:#54575b !important;">Total Unit Price</th>
                        <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <span style="font-size:15px; color:#54575b !important;">
                            {{ WordAmount(amountChecker) }} <br> -->
                            {{
                                AmountConvertToHalfWord(Math.floor(pc.selectedProjectUnit.total_unit_amount ? pc.selectedProjectUnit.total_unit_amount : 0))
                            }}
                        </span>
                        </td>
                    </tr>

                    <tr>
                        <th style="color:#54575b !important;">Size</th>
                        <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                        <span v-if="pc.selectedProjectUnit.covered_area != null">
                            <span
                                style="font-size:15px; color:#54575b !important;">{{
                                    parseInt(pc.selectedProjectUnit.covered_area / pc.selectedProjectUnit.measurement.convertor)
                                }}</span>
                            <span
                                style="font-size:15px; color:#54575b !important;">{{
                                    pc.selectedProjectUnit.measurement ? pc.selectedProjectUnit.measurement.symbol : "--"
                                }}</span>
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
                            <span style="font-size:15px; color:#54575b !important;">
                            {{
                                    AmountConvertToHalfWord(Math.floor(pc.selectedProjectUnit.monthly_installment ? pc.selectedProjectUnit.monthly_installment : 0))
                                }}
                        </span>
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
                        <span style="font-size:15px; color:#54575b !important;">{{
                                pc.selectedProjectUnit.installment
                            }}</span>
                        </td>
                    </tr>

                    <tr>
                        <th style="color:#54575b !important;">Loan Amount</th>
                        <td class="compare_table_width" v-for="(pc, index) in arrProjectsCompare">
                            <!-- <span>{{ pc.selectedProjectUnit.loan_amount }}</span> -->
                            <span style="font-size:15px; color:#54575b !important;">
                            {{
                                    AmountConvertToHalfWord(Math.floor(pc.selectedProjectUnit.loan_amount ? pc.selectedProjectUnit.loan_amount : 0))
                                }}
                        </span>
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
                  " onerror="this.src='/assets/images/not-found.png'"/>
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
                  " onerror="this.src='/assets/images/not-found.png'"/>
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
                    <tr v-if="arrDistinctRoomTypes.length > 0">
                        <th>Additional Details</th>
                        <td :colspan="arrProjectsCompare.length">
                            <button type="button" class="btn btn-thm col-md-12" data-toggle="collapse"
                                    :data-target="'#additional-details-123'">
                            <span>
                                Show/Hide
                            </span>
                                <!-- <span class="font-weight:700;">
                                        {{rt.roomTypeName}}
                                    </span> -->
                            </button>
                        </td>
                    </tr>
                    <tr v-for="(rt, rtIndex) in arrDistinctRoomTypes" id="additional-details-123" class="collapse show">

                        <th style="color:#54575b !important;">
                        <span>
                            <i :class="'fa '+ (rt.objRoomType ? rt.objRoomType.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                        </span>
                            <span>{{ rt.roomTypeName }}</span>
                        </th>
                        <td class="compare_table_width" v-for="(pc, pcIndex) in arrProjectsCompare">
                            <div v-if="pc.selectedProjectUnit.unit_rooms_details[rtIndex].rooms.length > 0">
                                <button type="button" class="btn btn-thm col-md-12 d-none" data-toggle="collapse"
                                        :data-target="'#additional-details-'+pc.selectedProjectUnit.id+'-'+rt.room_type_id+'-'+rtIndex">
                                <span>
                                    Show/Hide
                                </span>
                                    <!-- <span class="font-weight:700;">
                                        {{rt.roomTypeName}}
                                    </span> -->
                                </button>
                                <div
                                    :id="'additional-details-'+pc.selectedProjectUnit.id+'-'+rt.room_type_id+'-'+rtIndex"
                                    class="collapse show col-md-12 m-t-10">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead style="background-color:#ec1c24; color:white;font-size:16px;">
                                            <tr>
                                                <!-- <th>{{rt.roomTypeName}}</th> -->
                                                <th>SNo.</th>

                                                <!-- <th style="background-color:#fff; color:#ec1c24;">
                                                <span>Facilities</span><br>
                                            </th> -->
                                                <th>
                                                    <span>Dimensions</span>
                                                </th>
                                                <!-- <th>Covered Area</th> -->
                                            </tr>
                                            </thead>
                                            <tbody class="b-600" style="font-size:15px;">
                                            <tr v-for="(rm, rmIndex) in pc.selectedProjectUnit.unit_rooms_details[rtIndex].rooms">
                                                <td>
                                                    <!-- <span>{{rm.extras ? rm.extras : '0'}}</span> -->
                                                    <!-- <span>{{rt.roomTypeName ? rt.roomTypeName : ''}}</span> -->
                                                    <span>{{ rmIndex + 1 }}</span>
                                                </td>
                                                <!-- <td>
                                                <span>
                                                    <i :class="'fa '+ (rm.room_type ? rm.room_type.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                                                </span>
                                                <span>{{rm.extras ? rm.extras : '0'}}</span>
                                                <span>{{rm.room_type ? rm.room_type.name : '-'}}</span>
                                            </td> -->
                                                <td>

                                                    (
                                                    <span>{{
                                                            rm.width_feet ? rm.width_feet : '0'
                                                        }}.{{ rm.width_inches ? rm.width_inches : '0' }}</span>
                                                    <span> x </span>
                                                    <span>{{
                                                            rm.length_feet ? rm.length_feet : '0'
                                                        }}.{{ rm.length_inches ? rm.length_inches : '0' }}</span>
                                                    )

                                                </td>
                                                <!-- <td>{{rm.covered_area ? rm.covered_area + ' SQ.FT' : '-'}}</td> -->
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <h4 class="b-600 text-red">N/A</h4>
                                <!-- <h4 class="b-600 text-red">NA</h4> -->
                            </div>
                        </td>
                    </tr>

                    <tr v-if="compareProjectAmenitiesIsFound">
                        <th style="color:#54575b !important;">
                            Amenities
                        </th>
                        <td v-for="(pc, index) in arrProjectsCompare">
                            <div v-if="pc.project_amenities.length > 0">
                                <div v-for="(am, index) in pc.project_amenities"
                                     style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">
                                    {{ am.amenity ? am.amenity.amenity_name : "-" }}
                                </div>
                            </div>
                            <div v-else>
                                <h4 class="b-600 text-red">N/A</h4>
                            </div>
                            <!-- <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Tv Lounge</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Drawing Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Dining Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Kitchen</div> -->
                        </td>
                    </tr>

                    <tr v-if="compareProjectUtilsIsFound">
                        <th style="color:#54575b !important;">
                            Utilites
                        </th>
                        <td v-for="(pc, index) in arrProjectsCompare">
                            <div v-if="pc.project_utils.length > 0">
                                <div v-for="(ut, index) in pc.project_utils"
                                     style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">
                                    {{ ut.utility ? ut.utility.utility_name : "-" }}
                                </div>
                            </div>
                            <div v-else>
                                <h4 class="b-600 text-red">N/A</h4>
                            </div>
                            <!-- <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Tv Lounge</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Drawing Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Dining Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Kitchen</div> -->
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

                <table class="table table-bordered table-striped compare_tbl_mobile" style="width: 100%" mobile-view>
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
                        <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                            <div>
                                <h4 style="color: #ec1c24; font-weight:600;width:82%;float:left;">
                                    <a :href="'/project/'+pc.slug" target="_blank"
                                       style="color: #ec1c24; font-weight:600;text-decoration:underline;">
                                        {{ pc.name }}
                                    </a>
                                </h4>
                                <a class="remove-item" data-toggle="tooltip" title="Change Project"
                                   v-on:click="deleteCompareProject(pc)"
                                   style="background: red;color: white;padding: 0px 4px 0px 4px;cursor:pointer;">
                                    <i style="font-size: 15px" class="fa fa-close red"></i>
                                </a>
                            </div>
                            <div class="text-right" style="margin-bottom: -30px;position: relative;">

                            </div>
                        </td>
                    </tr>

                    <!-- <tr>
                        <th colspan="2">Project Image</th>
                    </tr> -->

                    <tr>
                        <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                            <div>
                                <div class="comparison-item">
                                    <img width="100%" height="100%" :src="'/'+pc.project_cover_img"/>
                                </div>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <th colspan="2" style="color:#54575b !important;">Location</th>
                    </tr>

                    <tr>
                        <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                            <div class="compare_limit_txt" style="font-size: 17px; color:#ec1c24 !important;"><i
                                class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{ pc.address }}
                            </div>
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
                                {{ pc.selectedProjectUnit.type ? pc.selectedProjectUnit.type.title : "--" }}
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
                        <th colspan="2" style="color:#54575b !important;">Projet Unit</th>
                    </tr>
                    <tr>
                        <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                            <div style="width:100%; font-size: 17px" class="candidate_revew_select_drop">
                                <!-- v-model="pc.selectedProjectUnit" -->
                                <select v-model="pc.selectedProjectUnitId"
                                        v-on:change="changeCompareProjectUnits(index, pc)" class="form-control"
                                        placeholder="Search Project Unit" required>
                                    <option disabled class="text-red" v-if="pc.units.length < 1">
                                        Project Units Are Not Found.
                                    </option>
                                    <option v-else v-for="(fpu, index) in pc.units" :value="fpu.id">
                                        {{ fpu.title }}
                                    </option>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" style="color:#54575b !important;">Total Unit Price</th>
                    </tr>

                    <tr>
                        <td style="width:50%; font-size: 17px" v-for="(pc, index) in arrProjectsCompare">
                            <!-- <span>{{ pc.selectedProjectUnit.price }}</span> -->
                            <span style="font-size: 17px;">{{
                                    Math.floor(pc.selectedProjectUnit.total_unit_amount ? pc.selectedProjectUnit.total_unit_amount : 0).toString()
                                }}</span>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" style="color:#54575b !important;">Size</th>
                    </tr>

                    <tr>
                        <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">

                        <span v-if="pc.selectedProjectUnit.covered_area != null">
                            <span style="font-size: 17px;">{{ parseInt(pc.selectedProjectUnit.covered_area) }}</span>
                            <span
                                style="font-size: 17px;">{{
                                    pc.selectedProjectUnit.measurement ? pc.selectedProjectUnit.measurement.symbol : "--"
                                }}</span>
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
                        <th colspan="2" style="color:#54575b !important;">Monthly Installment</th>
                    </tr>

                    <tr>
                        <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                        <span style="font-size: 17px;">{{
                                Math.floor(pc.selectedProjectUnit.monthly_installment ? pc.selectedProjectUnit.monthly_installment : 0).toString()
                            }}</span>
                            <!-- <span>{{ pc.selectedProjectUnit.monthly_installment }}</span> -->
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" style="color:#54575b !important;">Installment Length</th>
                    </tr>

                    <tr>
                        <td style="width:50%; font-size: 17px;" v-for="(pc, index) in arrProjectsCompare">
                            <span style="font-size: 17px;">{{ pc.selectedProjectUnit.installment }}</span>
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
                                <img style="height: 150px; width: 100%;" :src="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.payment_plan_img
                      : ''
                  " onerror="this.src='/assets/images/not-found.png'"/>
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
                                <img style="height: 150px; width: 100%" :src="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.floor_plan_img
                      : ''
                  " onerror="this.src='/assets/images/not-found.png'"/>
                            </a>
                        </td>
                    </tr>

                    <!-- <tr>
                            <th v-for="(pc, pcIndex) in arrProjectsCompare" style="color:#54575b !important;">
                                Unit Rooms
                            </th>
                        </tr>

                        <tr>
                            <td v-for="(pc, pcIndex) in arrProjectsCompare">
                                <div v-for="(urd , urdIndex) in pc.selectedProjectUnit.unit_rooms_details">

                                    <div>{{urd.roomTypeName}}</div>
                                    <br>
                                    <div class="col-md-12" v-for="(urdRm , urdRmIndex) in urd.rooms">
                                        <P class="col-md-6">{{urdRmIndex + 1}}</P>
                                        <P class="col-md-6">{{urdRm.covered_area}}</P>
                                    </div>
                                </div>
                            </td>
                        </tr> -->

                    <tr>
                        <th colspan="2" style="color:#54575b !important;">Additional Details</th>
                    </tr>

                    <tr v-if="arrDistinctRoomTypes.length > 0">

                        <td style="width:50%; font-size: 13px;" :colspan="arrProjectsCompare.length">
                            <button type="button" class="btn btn-thm col-md-12" data-toggle="collapse"
                                    :data-target="'#additional-details-123'">
                            <span>
                                Show/Hide
                            </span>
                                <!-- <span class="font-weight:700;">
                                        {{rt.roomTypeName}}
                                    </span> -->
                            </button>
                        </td>
                    </tr>

                    <!-- <tr v-for="(rt, rtIndex) in arrDistinctRoomTypes" id="additional-details-123" class="collapse show">
                            <th colspan="2" style="color:#54575b !important;">
                                <span>
                                    <i :class="'fa '+ (rt.objRoomType ? rt.objRoomType.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                                </span>
                                <span>{{rt.roomTypeName}}</span>
                            </th>

                        </tr>

                        <tr v-for="(rt, rtIndex) in arrDistinctRoomTypes">

                        </tr> -->

                    <tr colspan="2" v-for="(rt, rtIndex) in arrDistinctRoomTypes" id="additional-details-123"
                        class="collapse show">
                        <th :colspan="arrProjectsCompare.length">
                        <span>
                            <i :class="'fa '+ (rt.objRoomType ? rt.objRoomType.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                        </span>
                            <span>{{ rt.roomTypeName }}</span>
                        <td style="width:50%;" class="compare_table_width" v-for="(pc, pcIndex) in arrProjectsCompare">
                            <div v-if="pc.selectedProjectUnit.unit_rooms_details[rtIndex].rooms.length > 0">
                                <button type="button" class="btn btn-thm col-md-12 d-none" data-toggle="collapse"
                                        :data-target="'#additional-details-'+pc.selectedProjectUnit.id+'-'+rt.room_type_id+'-'+rtIndex">
                                <span>
                                    Show/Hide
                                </span>
                                    <!-- <span class="font-weight:700;">
                                        {{rt.roomTypeName}}
                                    </span> -->
                                </button>
                                <div
                                    :id="'additional-details-'+pc.selectedProjectUnit.id+'-'+rt.room_type_id+'-'+rtIndex"
                                    class="collapse show col-md-12 m-t-10">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <!-- <tr style="background-color:#fff; color:#54575B;font-size:16px;">
                                                <td colspan="2">
                                                    <span>
                                                        <i :class="'fa '+ (rt.objRoomType ? rt.objRoomType.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                                                    </span>
                                                    <span>{{rt.roomTypeName}}</span>
                                                </td>
                                            </tr> -->
                                            <tr style="background-color:#ec1c24; color:#fff;font-size:16px;">
                                                <!-- <th>{{rt.roomTypeName}}</th> -->
                                                <th>SNo.</th>

                                                <!-- <th style="background-color:#fff; color:#ec1c24;">
                                                <span>Facilities</span><br>
                                            </th> -->
                                                <th>
                                                    <span>Dimensions</span>
                                                </th>
                                                <!-- <th>Covered Area</th> -->
                                            </tr>
                                            </thead>
                                            <tbody class="b-600" style="font-size:15px;">
                                            <tr v-for="(rm, rmIndex) in pc.selectedProjectUnit.unit_rooms_details[rtIndex].rooms">
                                                <td>
                                                    <!-- <span>{{rm.extras ? rm.extras : '0'}}</span> -->
                                                    <!-- <span>{{rt.roomTypeName ? rt.roomTypeName : ''}}</span> -->
                                                    <span>{{ rmIndex + 1 }}</span>
                                                </td>
                                                <!-- <td>
                                                <span>
                                                    <i :class="'fa '+ (rm.room_type ? rm.room_type.icon : '')" style="color:#ec1c2;"></i>&nbsp;:
                                                </span>
                                                <span>{{rm.extras ? rm.extras : '0'}}</span>
                                                <span>{{rm.room_type ? rm.room_type.name : '-'}}</span>
                                            </td> -->
                                                <td>

                                                    (
                                                    <span>{{
                                                            rm.width_feet ? rm.width_feet : '0'
                                                        }}.{{ rm.width_inches ? rm.width_inches : '0' }}</span>
                                                    <span> x </span>
                                                    <span>{{
                                                            rm.length_feet ? rm.length_feet : '0'
                                                        }}.{{ rm.length_inches ? rm.length_inches : '0' }}</span>
                                                    )

                                                </td>
                                                <!-- <td>{{rm.covered_area ? rm.covered_area + ' SQ.FT' : '-'}}</td> -->
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <h4 class="b-600 text-red">N/A</h4>
                                <!-- <h4 class="b-600 text-red">NA</h4> -->
                            </div>
                        </td>
                        </th>
                    </tr>

                    <tr>
                        <th colspan="2" style="color:#54575b !important;">Amenities</th>
                    </tr>

                    <tr v-if="compareProjectAmenitiesIsFound">

                        <td style="width:50%; font-size: 15px;" v-for="(pc, index) in arrProjectsCompare">
                            <div v-if="pc.project_amenities.length > 0">
                                <div v-for="(am, index) in pc.project_amenities"
                                     style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">
                                    {{ am.amenity ? am.amenity.amenity_name : "-" }}
                                </div>
                            </div>
                            <div v-else>
                                <h4 class="b-600 text-red">N/A</h4>
                            </div>
                            <!-- <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Tv Lounge</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Drawing Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Dining Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Kitchen</div> -->
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" style="color:#54575b !important;">Utilites</th>
                    </tr>

                    <tr v-if="compareProjectUtilsIsFound">

                        <td style="width:50%; font-size: 15px;" v-for="(pc, index) in arrProjectsCompare">
                            <div v-if="pc.project_utils.length > 0">
                                <div v-for="(ut, index) in pc.project_utils"
                                     style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">
                                    {{ ut.utility ? ut.utility.utility_name : "-" }}
                                </div>
                            </div>
                            <div v-else>
                                <h4 class="b-600 text-red">N/A</h4>
                            </div>
                            <!-- <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Tv Lounge</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Drawing Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Dining Room</div>
                            <div style="background: rgb(255, 240, 242); padding: 5px; margin: 5px; color: rgb(227, 44, 44); border-radius: 7px; display: inline-block;">Kitchen</div> -->
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


@endsection
@section('footer')

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
            compareProjectUtilsIsFound: false,
            compareProjectAmenitiesIsFound: false,
            amountChecker: 0,
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
        // console.log("amountInWords -> 10000 -> ", amountInWords(10000));
        // console.log(
        //     "ConvertAmountToHalfWord -> 10000 -> ",
        //     ConvertAmountToHalfWord(10000)
        // );

        // console.log("amountInWords -> 100000 -> ", amountInWords(100000));
        // console.log(
        //     "ConvertAmountToHalfWord -> 100000 -> ",
        //     ConvertAmountToHalfWord(100000)
        // );

        // console.log("amountInWords -> 150000 -> ", amountInWords(150000));
        // console.log(
        //     "ConvertAmountToHalfWord -> 150000 -> ",
        //     ConvertAmountToHalfWord(150000)
        // );

        // console.log("amountInWords -> 1000000 -> ", amountInWords(1000000));
        // console.log(
        //     "ConvertAmountToHalfWord -> 1000000 -> ",
        //     ConvertAmountToHalfWord(1000000)
        // );

        // console.log("amountInWords -> 1500000 -> ", amountInWords(1500000));
        // console.log(
        //     "ConvertAmountToHalfWord -> 1500000 -> ",
        //     ConvertAmountToHalfWord(1500000)
        // );

        // console.log("amountInWords -> 10000000 -> ", amountInWords(10000000));
        // console.log(
        //     "ConvertAmountToHalfWord -> 10000000 -> ",
        //     ConvertAmountToHalfWord(10000000)
        // );

        // console.log("amountInWords -> 120002300 -> ", amountInWords(120002300));
        // console.log(
        //     "ConvertAmountToHalfWord -> 120002300 -> ",
        //     ConvertAmountToHalfWord(120002300)
        // );
    },
    watch: {
        // filteredProjects: function (val) {
        //   this.filteredProjects = val;
        //   alert(JSON.stringify(val));
        // },
    },
    mounted() {
        console.log("Component mounted.");
        // let externalScript = document.createElement('script')
        // externalScript.setAttribute('src', '../../../public/js/helper.js')
        // document.head.appendChild(externalScript)
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
        changeCompareProjectUnits(index, selectedProject) {
            try {
                // console.log("changeCompareProjectUnits -> selectedProjectUnit -> " , JSON.stringify(selectedProject));
                let arrProjectUnit = selectedProject.units.filter(
                    (x) => x.id == selectedProject.selectedProjectUnitId
                );
                if (arrProjectUnit.length < 1) {
                    alert("Unit not found please reload the page and try again.");
                    return;
                }

                let changedProjectUnit = arrProjectUnit[0];
                // console.log("changedProjectUnit -> New", changedProjectUnit.id);

                // console.log(
                //   "changedProjectUnit -> Old",
                //   this.arrProjectsCompare[index].previousSelectedProjectUnit.id
                // );
                let idsArr = [];
                this.arrProjectsCompare.forEach((compareProject) => {
                    idsArr.push(compareProject.selectedProjectUnitId);
                    // console.log("forEach -> previousSelectedProjectUnit -> ",value.previousSelectedProjectUnit.id);
                });
                // console.log("index_1", index);
                // console.log("forEach -> idsArr -> ", idsArr);
                // console.log(
                //     "condition -> ",
                //     this.arrProjectsCompare.filter((x) => x.selectedProjectUnit.id == projectUnit.id).length
                // );

                this.arrProjectsCompare[index].selectedProjectUnit = changedProjectUnit;
                this.arrProjectsCompare[index].selectedProjectUnitId =
                    changedProjectUnit.id;
                this.reGenerateRoomTypesWithRooms();
                // console.log("this.arrProjectsCompare[index].selectedProjectUnitId -> ", this.arrProjectsCompare[index].selectedProjectUnitId);
                // console.log("this. arrDistinctRoomTypes -> " , JSON.stringify(this.arrDistinctRoomTypes));
                // console.log("this. arrDistinctRoomTypes -> " , JSON.stringify(this.arrDistinctRoomTypes));

                if (
                    this.arrProjectsCompare.filter(
                        (x) => x.selectedProjectUnit.id == changedProjectUnit.id
                    ).length == 2
                ) {
                    ShowError("This unit type of this project is already selected.");
                    this.arrProjectsCompare[index].selectedProjectUnit =
                        this.arrProjectsCompare[index].previousSelectedProjectUnit;
                    this.arrProjectsCompare[index].selectedProjectUnitId =
                        this.arrProjectsCompare[index].previousSelectedProjectUnitId;
                    this.reGenerateRoomTypesWithRooms();
                    // Vue.set(this.arrProjectsCompare, index, this.arrProjectsCompare[index]);
                    return;
                } else {
                    this.arrProjectsCompare[index].previousSelectedProjectUnit =
                        this.arrProjectsCompare[index].selectedProjectUnit;
                    this.arrProjectsCompare[index].previousSelectedProjectUnitId =
                        this.arrProjectsCompare[index].selectedProjectUnitId;
                    // console.log("index_2", index);
                    // this.arrProjectsCompare[index].previousSelectedProjectUnit = projectUnit;
                    // console.log("index_3", index);
                    // this.arrProjectsCompare[index].selectedProjectUnit = projectUnit;
                    // console.log("index_4", index);

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
            } catch (error) {
                ShowError(error);
            }
        },
        addToCompare() {
            if (SubmitForm("frmAddToCompare")) {
                if (
                    this.arrProjectsCompare.filter(
                        (x) =>
                            x.id == this.newCompareReord.project.id &&
                            x.selectedProjectUnit.id == this.newCompareReord.projectUnit.id
                    ).length > 0
                ) {
                    ShowError("This project is already exist in compare box.");
                    return;
                }
                // console.log(
                //     "this.newCompareReord.projectUnit -> ",
                //     JSON.stringify(this.newCompareReord.projectUnit)
                // );
                let newRecId = create_UUID();
                this.newCompareReord.project.RecId = newRecId;
                this.newCompareReord.project.previousSelectedProjectUnit =
                    this.newCompareReord.projectUnit;
                this.newCompareReord.project.selectedProjectUnit =
                    this.newCompareReord.projectUnit;

                this.newCompareReord.project.previousSelectedProjectUnitId =
                    this.newCompareReord.projectUnit.id;
                this.newCompareReord.project.selectedProjectUnitId =
                    this.newCompareReord.projectUnit.id;

                // this.newCompareReord.project.selectedProjectUnit.unitRoomTypes = this.reGenerateRoomTypesWithRooms(this.newCompareReord.project.selectedProjectUnit);

                // console.log("addToCompare() -> this.arrDistinctRoomTypes ", JSON.stringify(this.arrDistinctRoomTypes));
                // console.log("addToCompare() -> this.arrDistinctRoomTypes.length ", JSON.stringify(this.arrDistinctRoomTypes.length));
                // console.log("addToCompare() -> this.newCompareReord.project.selectedProjectUnit/unitRoomTypes ", JSON.stringify(this.newCompareReord.project.selectedProjectUnit.unitRoomTypes));
                // console.log("addToCompare() -> this.newCompareReord.project ", JSON.stringify(this.newCompareReord.project));

                let newProject = JSON.stringify(this.newCompareReord.project);
                // console.log("newProject, -> ", newProject);
                newProject = JSON.parse(newProject);
                // newProject.unit_id = this.newCompareReord.projectUnit.id;
                this.arrProjectsCompare.push(newProject);
                this.newCompareReord.project = "";
                this.newCompareReord.projectUnit = "";
                this.filteredProjectUnits = [];

                let idsArr = [];
                this.arrProjectsCompare.forEach((compareProject, index) => {
                    idsArr.push(compareProject.selectedProjectUnit.id);
                    // console.log("forEach -> previousSelectedProjectUnit -> ",compareProject.previousSelectedProjectUnit.id);
                });

                this.reGenerateRoomTypesWithRooms();
                this.findCompareProjectUtilities();
                this.findCompareProjectAmenities();
                // console.log("addToCompare -> this.arrProjectsCompare -> ", JSON.stringify(this.arrProjectsCompare));
            }
        },
        deleteCompareProject(Record) {
            // console.log("this.arrProjectsCompare -> ", this.arrProjectsCompare);
            // console.log("Deleted Record -> ", Record);
            this.arrProjectsCompare = this.arrProjectsCompare.filter(
                (x) => x.RecId != Record.RecId
            );
            this.reGenerateRoomTypesWithRooms();
            this.findCompareProjectUtilities();
            this.findCompareProjectAmenities();
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
                                // console.log("this.selectedprojectid -? ", this.selectedprojectid);
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
            this.arrProjectsCompare.forEach((project) => {
                // let arrUnitRoomTypes = [];
                project.selectedProjectUnit.unit_rooms.forEach((x) => {
                    if (
                        this.arrDistinctRoomTypes.filter(
                            (y) => y.room_type_id == x.room_type_id
                        ).length < 1
                    ) {
                        this.arrDistinctRoomTypes.push({
                            room_type_id: x.room_type_id,
                            roomTypeName: x.room_type.name,
                            objRoomType: x.room_type,
                        });
                        // arrUnitRoomTypes.push({
                        //     room_type_id: x.room_type_id,
                        //     roomTypeName: x.room_type.name,
                        //     objRoomType: x.room_type
                        // });
                    }
                });
                // arrUnitRoomTypes.forEach(x => {
                //     x.rooms = project.selectedProjectUnit.unit_rooms.filter(y => y.room_type_id == x.room_type_id);
                //     x.roomCount = project.selectedProjectUnit.unit_rooms.filter(y => y.room_type_id == x.room_type_id).length;
                // });
                // project.selectedProjectUnit.unit_rooms_details = arrUnitRoomTypes;
            });
            this.arrProjectsCompare.forEach((project) => {
                let arrUnitRoomsWithType = [];
                this.arrDistinctRoomTypes.forEach((roomType) => {
                    let arrUnitTypeRooms = project.selectedProjectUnit.unit_rooms.filter(
                        (x) => x.room_type_id == roomType.room_type_id
                    );
                    arrUnitRoomsWithType.push({
                        room_type_id: roomType.room_type_id,
                        roomTypeName: roomType.roomTypeName,
                        objRoomType: roomType.objRoomType,
                        rooms: arrUnitTypeRooms,
                        roomCount: arrUnitTypeRooms.length,
                    });
                });
                project.selectedProjectUnit.unit_rooms_details = arrUnitRoomsWithType;
            });

            // console.log("reGenerateRoomTypesWithRooms() { -> this.arrDistinctRoomTypes -> length", JSON.stringify(this.arrDistinctRoomTypes.length));
            // console.log("reGenerateRoomTypesWithRooms() { -> this.arrDistinctRoomTypes -> ", JSON.stringify(this.arrDistinctRoomTypes));

            // console.log("reGenerateRoomTypesWithRooms() { -> this.arrProjectsCompare -> length", JSON.stringify(this.arrProjectsCompare.length));
            // console.log("reGenerateRoomTypesWithRooms() { -> this.arrProjectsCompare -> ", JSON.stringify(this.arrProjectsCompare));
        },
        findCompareProjectUtilities() {
            this.compareProjectUtilsIsFound = false;
            this.arrProjectsCompare.forEach((projectCompare) => {
                if (projectCompare.project_utils.length > 0) {
                    this.compareProjectUtilsIsFound = true;
                }
            });
        },
        findCompareProjectAmenities() {
            this.compareProjectAmenitiesIsFound = false;
            this.arrProjectsCompare.forEach((projectCompare) => {
                if (projectCompare.project_amenities.length > 0) {
                    this.compareProjectAmenitiesIsFound = true;
                }
            });
        },
        WordAmount(amount) {
            return amountInWords(amount);
        },
        AmountConvertToHalfWord(amount) {
            return ConvertAmountToHalfWord(amount);
        },
    },
    // roomTypes: {
    //     // getter
    //     get: function () {
    //         return this.roomTypes + ' ' + this.OldroomTypes
    //     },
    //     // setter
    //     set: function (newValue) {
    //         var names = newValue.split(' ')
    //         this.roomTypes = names[0]
    //         this.OldroomTypes = names[names.length - 1]
    //     }
    // },
    // vm.$watch('person.name.roomTypes', function (newValue, oldValue) {
    //     alert('First name changed from ' + oldValue + ' to ' + newValue + '!');
    // });
    // var vm = new Vue({
    //     el: '#example',
    //     data: {
    //         message: 'Hello'
    //     },
    //     computed: {
    //         // a computed getter
    //         reversedMessage: function () {
    //             // `this` points to the vm instance
    //             return this.message.split('').reverse().join('')
    //         }
    //     }
    // }),
    // reversedMessage: function () {
    //   // `this` points to the vm instance
    //   return this.message.split('').reverse().join('')
    // }
};
</script>
