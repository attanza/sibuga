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
        async populateData(customContainer = null) {
            try {
                this.loading = true;
                const queries = this.getQueries();
                const resp = await axios
                    .get(this.link + queries)
                    .then(res => res.data);
                if (customContainer) {
                    this[customContainer] = resp.data;
                } else {
                    this.items = resp.data;
                }
                this.setPaginationData(resp);
                this.loading = false;
            } catch (e) {
                this.loading = false;
                console.log("e", e);
            }
        },
        getQueries() {
            this.pagination.pictureableId = this.pictureableId;
            this.pagination.pictureableType = this.pictureableType;

            const {
                current_page,
                per_page,
                search,
                filterBy,
                filterValue,
                pictureableId,
                pictureableType
            } = this.pagination;
            return `?page=${current_page || 1}&perPage=${per_page ||
                10}&search=${search || ""}&filterBy=${filterBy ||
                ""}&filterValue=${filterValue ||
                ""}&pictureableId=${pictureableId ||
                ""}&pictureableType=${pictureableType || ""}`;
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
