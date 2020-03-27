import React, {Component} from 'react';
import axios from "axios";

class SearchFaq extends Component {
    constructor(props) {
        super(props);
    }

// Do the ajax request with a delay


    render() {
        return (
            <div>
                <form onSubmit={this.onSubmit} className="d-flex mb-2">
                    <div className="input-wrapper w-100">
                        <input id="faq_search_input"
                               className="w-100 form-control"
                               value={this.props.searchTerm}
                               placeholder={this.props.searchTerm}
                               type="search"
                               onChange={(e) => {this.props.handleChange(e)}} />
                    </div>
                </form>
            </div>
        );
    }
}

export default SearchFaq;
