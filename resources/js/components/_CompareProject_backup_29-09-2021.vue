<template>
  <div class="row">
    <h3 class="camp">Compare Projects</h3>
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
                    <label class="search_heading">Progress</label>
                    <select
                      v-model="searchFilter.progress"
                      v-on:change="changeProgress()"
                      class="selectpicker w100 show-tick"
                      data-live-search="true"
                      data-live-search-placeholder="Search Progress"
                      multiple
                    >
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
                    <label class="search_heading">Project Types</label>
                    <select
                      v-model="searchFilter.project_type"
                      v-on:change="changeProjectType()"
                      class="selectpicker w100 show-tick"
                      data-live-search="true"
                      multiple
                      data-live-search-placeholder="Search Project Type"
                    >
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
                    <label class="search_heading">Area</label>
                    <select
                      v-model="searchFilter.area"
                      v-on:change="changeArea()"
                      class="selectpicker w100 show-tick"
                      data-live-search="true"
                      multiple
                      data-live-search-placeholder="Search Area"
                    >
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
              <button
                type="button"
                id="submitRegisterForm"
                class="btn btn-thm"
                style="margin-top: 30px; height: 50%"
                v-on:click="searchByFilters()"
              >
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

          <div class="col-md-12 display-flex" id="frmAddToCompare">
            <div class="col-md-5">
              <div class="form-group">
                <div class="search_option_two">
                  <div class="candidate_revew_select">
                    <label class="search_heading"
                      >Project <span class="text-red">*</span></label
                    >
                    <select
                      v-model="newCompareReord.project"
                      v-on:change="changeProject()"
                      class="form-control"
                      data-live-search="true"
                      data-live-search-placeholder="Search Project"
                      required
                    >
                      <option value="">--Select Project--</option>
                      <option
                        value=""
                        disabled
                        v-if="filteredProjects.length < 1"
                        class="text-red"
                      >
                        Projects Are Not Found.
                      </option>
                      <option
                        v-for="(fp, index) in filteredProjects"
                        :value="fp"
                      >
                        {{ fp.name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <div class="search_option_two">
                  <div class="candidate_revew_select">
                    <label class="search_heading"
                      >Project Units <span class="text-red">*</span></label
                    >
                    <select
                      v-model="newCompareReord.projectUnit"
                      class="form-control"
                      data-live-search="true"
                      data-live-search-placeholder="Search Project Unit"
                      required
                    >
                      <option value="">--Select Project Units--</option>
                      <option
                        value=""
                        disabled
                        class="text-red"
                        v-if="filteredProjectUnits.length < 1"
                      >
                        Project Units Are Not Found.
                      </option>
                      <option
                        v-else
                        v-for="(fpu, index) in filteredProjectUnits"
                        :value="fpu"
                      >
                        {{ fpu.title }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-2" v-if="arrProjectsCompare.length < 2">
              <button
                type="button"
                class="btn btn-log btn-block btn-thm"
                style="margin-top: 30px"
                v-on:click="addToCompare">
                Add To Compare
              </button>
            </div>
          </div>

          <!-- <div class="panel-footer">Panel Footer</div> -->
        </div>
      </div>
    </div>

    <div class="col-md-12 display-flex" v-if="arrProjectsCompare.length > 0">
      <!-- <h2>Compare Box</h2><br> -->
      <div class="col-6 display-flex"v-for="(pc, index) in arrProjectsCompare">
              
        <div class="col-md-6">
          <h3 style="text-decoration: underline">Project {{ index + 1 }}</h3>
        </div>
        <div class="col-md-6 text-right">
          <button class="btn btn-danger" v-on:click="deleteCompareProject(pc)">
            Change Project
          </button>
        </div>
        <div class="col-md-12">
          <h2>{{ pc.name }}</h2>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            
            <div>
              <img 
                :src="pc.project_cover_img"
                alt=""
                width="100%"
                style=""
                height="300px"
              />
            </div>
          </div>
        </div>
        <div class="col-md-12 display-flex">
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Project Name</label><br />
              <span>{{ pc.name }}</span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="project-detail-label">Address</label><br />
              <span>{{ pc.address }}</span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="project-detail-label">Progress</label><br />
              <span>{{ pc.progress }}</span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="project-detail-label">Description</label><br />
              <div v-html="pc.details"></div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="search_option_two">
                <div class="candidate_revew_select">
                  <label class="search_heading"
                    >Project Units <span class="text-red">*</span></label
                  >
                  <!-- v-model="pc.selectedProjectUnit" -->
                  <select
                    v-model="pc.selectedProjectUnit"
                    v-on:change="
                      changeCompareProjectUnits(index, pc.selectedProjectUnit)
                    "
                    class="form-control"
                    data-live-search="true"
                    data-live-search-placeholder="Search Project Unit"
                    required
                  >
                    <option
                      disabled
                      class="text-red"
                      v-if="filteredProjectUnits.length < 1"
                    >
                      Project Units Are Not Found.
                    </option>
                    <option
                      v-else
                      v-for="(fpu, index) in pc.units"
                      :value="fpu"
                    >
                      {{ fpu.title }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <h3>{{ pc.selectedProjectUnit.title }}</h3>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Price</label><br />
              <span>{{ pc.selectedProjectUnit.price }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Rooms</label><br />
              <span>{{ pc.rooms ? pc.rooms : "--" }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Area</label><br />
              <p v-for="(ar, index) in pc.areas">
                {{ ar.name }}
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Location</label><br />
              <span>{{ pc.location ? pc.location.name : "-" }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Monthly Installment</label
              ><br />
              <span>{{ pc.selectedProjectUnit.monthly_installment }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Installment Type</label><br />
              <span>{{
                pc.selectedProjectUnit.installments
                  ? pc.selectedProjectUnit.installments.name
                  : "--"
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Installment Length</label
              ><br />
              <span>{{ pc.installment_length }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Loan Amount</label><br />
              <span>{{ pc.selectedProjectUnit.loan_amount }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="project-detail-label">Unit Description</label><br />
              <span>{{
                pc.selectedProjectUnit.description
                  ? pc.selectedProjectUnit.description
                  : "-"
              }}</span>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="project-detail-label">Installment Plan</label><br />
              <div style="height: 400px">
                <a
                  :href="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.payment_plan_img
                      : ''
                  "
                  target="_blank"
                >
                  <img
                    :src="
                      pc.selectedProjectUnit.payment_plan_img
                        ? '/uploads/project_images/project_' +
                          pc.id +
                          '/unit_' +
                          pc.selectedProjectUnit.id +
                          '/' +
                          pc.selectedProjectUnit.payment_plan_img
                        : ''
                    "
                    alt=""
                    height="100%"
                    width="100%"
                  />
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="project-detail-label">Floor Plan</label><br />
              <div style="height: 400px">
                <a
                  :href="
                    pc.selectedProjectUnit.payment_plan_img
                      ? '/uploads/project_images/project_' +
                        pc.id +
                        '/unit_' +
                        pc.selectedProjectUnit.id +
                        '/' +
                        pc.selectedProjectUnit.floor_plan_img
                      : ''
                  "
                  target="_blank"
                >
                  <img
                    :src="
                      pc.selectedProjectUnit.payment_plan_img
                        ? '/uploads/project_images/project_' +
                          pc.id +
                          '/unit_' +
                          pc.selectedProjectUnit.id +
                          '/' +
                          pc.selectedProjectUnit.floor_plan_img
                        : ''
                    "
                    alt=""
                    height="100%"
                    width="100%"
                  />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["areas", "projecttypes", "tags"],
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
    };
  },
  created() {
    console.log("Component Created.");
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
      console.log("forEach -> idsArr -> ", idsArr);
      console.log(
        "condition -> ",
        this.arrProjectsCompare.filter(
          (x) => x.selectedProjectUnit.id == projectUnit.id
        ).length
      );
      if (
        this.arrProjectsCompare.filter(
          (x) => x.selectedProjectUnit.id == projectUnit.id
        ).length == 2 
      ) {
        ShowError("This unit type of this project is already selected.");
        this.arrProjectsCompare[index].selectedProjectUnit =
          this.arrProjectsCompare[index].previousSelectedProjectUnit;
        // Vue.set(this.arrProjectsCompare, index, this.arrProjectsCompare[index]);
        return;
      } else {
        this.arrProjectsCompare[index].previousSelectedProjectUnit = projectUnit;
        this.arrProjectsCompare[index].selectedProjectUnit = projectUnit;





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
    // testCaseDuplicate1(array) {
    //   let newArray = array.map(function(item) {
    //     return {
    //       'color': item.color,
    //       'count': 0,
    //     };
    //   });
    //   let arrayUnique = [];
    //   let arrayAdded = [];
    //   let loopComplete = false;

    //   if (loopComplete == false) {
    //     for (let i = 0; i < newArray.length; i++) {
    //       if (!arrayAdded.includes(newArray[i].color)) {
    //         arrayAdded.push(newArray[i].color);
    //         arrayUnique.push(newArray[i]);
    //       }
    //     }
    //     loopComplete = true;
    //     return arrayUnique;
    //   } else {
    //     for (let i = 0; i < newArray.length; i++) {
    //       if (arrayUnique.includes(newArray[i].color)) {
    //         arrayUnique[i].count++;
    //       }
    //       return arrayUnique;
    //     }
    //   }
    // },
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

        let newRecId = create_UUID();
        this.newCompareReord.project.RecId = newRecId;
        this.newCompareReord.project.previousSelectedProjectUnit =
          this.newCompareReord.projectUnit;
        this.newCompareReord.project.selectedProjectUnit =
          this.newCompareReord.projectUnit;
        // console.log(
        //   "addToCompare() -> this.newCompareReord.project ",
        //   JSON.stringify(this.newCompareReord.project)
        // );
        let newProject = JSON.stringify(this.newCompareReord.project);
        this.arrProjectsCompare.push(JSON.parse(newProject));
        this.newCompareReord.project = "";
        this.newCompareReord.projectUnit = "";
        let idsArr = [];
        this.arrProjectsCompare.forEach((value, index) => {
          idsArr.push(value.selectedProjectUnit.id);
          // console.log("forEach -> previousSelectedProjectUnit -> ",value.previousSelectedProjectUnit.id);
        });
        console.log("forEach -> idsArr -> ", idsArr);
      }
    },
    deleteCompareProject(Record) {
      console.log("this.arrProjectsCompare -> ", this.arrProjectsCompare);
      console.log("Deleted Record -> ", Record);
      this.arrProjectsCompare = this.arrProjectsCompare.filter(
        (x) => x.RecId != Record.RecId
      );
    },
    changeProject() {
      this.filteredProjectUnits = this.newCompareReord.project.units;
      console.log(
        "this.newCompareReord.project -> ",
        this.newCompareReord.project
      );
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
              this.filteredProjects = response.data.data;
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
    // compareTest() {
    //   var date1 = new Date();
    //   var date2 = new Date(2019 - 08 - 03);
    //   if (date1.getTime() < date2.getTime()) document.write("date is valid");
    //   else if (date1.getTime() > date2.getTime())
    //     document.write("date is expired");
    //   else document.write("date is valid today only");
    //   var result1 = [
    //     { id: 1, name: "Sandra", type: "user", username: "sandra" },
    //     { id: 2, name: "John", type: "admin", username: "johnny2" },
    //     { id: 3, name: "Peter", type: "user", username: "pete" },
    //     { id: 4, name: "Bobby", type: "user", username: "be_bob" },
    //   ];

    //   var result2 = [
    //     { id: 2, name: "John", email: "johnny@example.com" },
    //     { id: 4, name: "Bobby", email: "bobby@example.com" },
    //   ];

    //   var props = ["id", "name"];

    //   var result = result1
    //     .filter(function (o1) {
    //       // filter out (!) items in result2
    //       return !result2.some(function (o2) {
    //         return o1.id === o2.id; // assumes unique id
    //       });
    //     })
    //     .map(function (o) {
    //       // use reduce to make objects with only the required properties
    //       // and map to apply this to the filtered array as a whole
    //       return props.reduce(function (newo, name) {
    //         newo[name] = o[name];
    //         return newo;
    //       }, {});
    //     });

    //   axios({
    //     method: "GET",
    //     url: url,
    //   }).then(
    //     (result) => {
    //       this.json = result.data;
    //     },
    //     (error) => {
    //       console.log(error);
    //     }
    //   );
    // },
  },
};
</script>
