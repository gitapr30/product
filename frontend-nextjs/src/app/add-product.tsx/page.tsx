'use client';

import React, { useState } from 'react';        

export default function AddProduct() {
  const [name, setName] = useState('');
  const [price, setPrice] = useState('');     
  const [stock, setStock] = useState('');    

    const handleSubmit = async (e: React.FormEvent) => {
      e.preventDefault();
      const res = await fetch('http://localhost/product/product.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name, price, stock}),
      });
      if (res.ok) {
        // Handle success
      } else {
        // Handle error
      }
    };
    return (
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Product Name"
          value={name}
          onChange={(e) => setName(e.target.value)}
        />
        <input
          type="number"
          placeholder="Product Price"
          value={price}
          onChange={(e) => setPrice(e.target.value)}
        />
        <input
          type="number"
          placeholder="Product Stock"
          value={stock}
          onChange={(e) => setStock(e.target.value)}
        />
        <button type="submit">Add Product</button>
      </form>
    );      

}