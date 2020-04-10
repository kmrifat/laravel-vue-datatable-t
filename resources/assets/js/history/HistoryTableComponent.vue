<template>
    <section>
        <h3>History</h3>
        <div class="panel panel-default">

            <div class="panel-body">

                <form @click.prevent="searchPosts" class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="search">Search</label>
                        <input type="text" v-model="search.query" class="form-control" id="search" placeholder="Search">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="date">Date</label>
                        <date-picker v-model="search.date" valueType="format"></date-picker>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="sort">Sort By</label>
                        <select v-model="search.group_id" id="" class="form-control">
                            <option value="">All Group</option>
                            <option :value="group" v-for="group of group_types">{{ group }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">Search</button>
                </form>

                <table class="table table-hover social-accounts">
                    <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Group Type</th>
                        <th>Account Name</th>
                        <th>Post Text</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="post of posts.data">
                        <td>{{ post.group_info.name }}</td>
                        <td>{{ post.group_info.type }}</td>
                        <td>
                            <div class="media">
                                <div class="media-left">
                                    <a>
                                        <span :class="'fa fa-'+post.account_info.type"></span>
                                        <img width="50" class="media-object img-circle" :src="post.account_info.avatar" alt="">
                                    </a>
                                </div>
                            </div>

                            <!--                            {{ post.account_info.name }}-->
                        </td>
                        <td>{{ post.post_text }}</td>
                        <td>{{ post.created_at | dateTime }}</td>
                    </tr>
                    </tbody>
                </table>

                <pagination :data="posts" :limit="10" @pagination-change-page="paginateData"></pagination>


            </div>
        </div>
    </section>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';

    export default {
        name: "HistoryTableComponent",
        components: {
            DatePicker
        },
        data() {
            return {
                posts: '',
                group_types: [],
                search: {
                    query: '',
                    date: '',
                    group_id: ''
                },
                current_page: 0,
                page: '',
            }
        },
        methods: {
            gettingAllData() {
                axios.get(`/get-all-history?query=${this.search.query}&date=${this.search.date}&group_id=${this.search.group_id}&page=${this.page}`).then(response => {
                    console.log(response.data);
                    this.posts = response.data;
                    this.current_page = response.data.current_page;
                }).catch(e => {

                })
            },

            paginateData(page_number) {
                this.page = page_number;
                this.$router.push({
                    name: 'history',
                    query: {query: this.search.query, data: this.search.date, group: this.search.group_id, page: this.page}
                }).catch(e => {
                    // do nothing
                });
                this.gettingAllData();
            },

            searchPosts() {
                this.page = '';
                this.$router.push({
                    name: 'history',
                    query: {query: this.search.query, data: this.search.date, group: this.search.group_id}
                }).catch(e => {
                    // do nothing
                });
                console.log(this.$route);
                this.gettingAllData();
            },

            getGroupTypes() {
                axios.get('/get-all-group-types').then(response => {
                    this.group_types = response.data;
                }).catch(e => {
                    // do nothing
                })
            }
        },
        mounted() {
            this.gettingAllData();
        },
        beforeMount() {
            this.getGroupTypes();
        }
    }
</script>

<style scoped>

</style>
