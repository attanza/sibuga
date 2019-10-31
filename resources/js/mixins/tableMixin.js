import moment from "moment";

export default {
    data() {
        return {
            items: [],
            pagination: {},
            loading: false
        };
    },

    methods: {
        async populateData() {
            try {
                this.loading = true;
                const queries = this.getQueries();
                const resp = await axios
                    .get(this.link + queries)
                    .then(res => res.data);
                this.items = resp.data;
                this.setPaginationData(resp);
                this.loading = false;
            } catch (e) {
                this.loading = false;
                console.log("e", e);
            }
        },
        getQueries() {
            const {
                current_page,
                per_page,
                search,
                filterBy,
                filterValue
            } = this.pagination;
            return `?page=${current_page || 1}&perPage=${per_page ||
                10}&search=${search || ""}&filterBy=${filterBy ||
                ""}&filterValue=${filterValue || ""}`;
        },
        setPaginationData(data) {
            this.pagination = data;
            delete this.pagination["data"];
        },
        onChangePage(page) {
            this.pagination.current_page = page;
            this.populateData();
        },
        onPerPageChange(perPage) {
            this.pagination.per_page = perPage;
            this.populateData();
        },
        onSearch(query) {
            this.pagination.search = query;
            this.populateData();
        },
        currencyFormat(num) {
            return num
                .replace(".", ",") // replace decimal point character with ,
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // use . as a separator
        },
        dateFormat(date) {
            return moment(date).format("DD MMM YYYY");
        }
    }
};
