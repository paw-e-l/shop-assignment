import React from 'react';

export default ({ items }) => {
    
    return (
    <div className="products">{ items.map(product => (
        <div key={product.id}>
            <h4>{product.name}</h4>
            <img src={`https://picsum.photos/id/${product.id}/260/200`} />
            <div className="price">{product.price} {product.currency}</div>
        </div>
    )) }</div>
    )
}