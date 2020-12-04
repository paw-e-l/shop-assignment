import React from 'react';
import ProductsList from '../components/home';
import ReactPaginate from 'react-paginate';
    
export default class Home extends React.Component {

    constructor() {
        super();
        this.state = {
            items: [],
            page: 0,
            per_page: 10,
            total_count: 0,
        }
        this.handlePageClick = this.handlePageClick.bind(this);
    }

    componentDidMount() {
        this.loadPage(0);
    }

    loadPage(pageNumber) {
        return fetch('api/products/'+pageNumber).then(response => {
            return response.json();
        }).then(response => {
            this.setState({ ...response.data });
        });
    }

    handlePageClick({ selected }) {
        this.loadPage(selected);
    }

    render() {
        return <React.Fragment>
            <ProductsList {...this.state} />
            <ReactPaginate onPageChange={this.handlePageClick} containerClassName={'pagination'} pageCount={Math.ceil(this.state.total_count / this.state.per_page)} />
        </React.Fragment>
    }
}
