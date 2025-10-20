'use client';

import React, { useState } from 'react';  

interface product {
  id: number;
  name: string;
  price: number;
}

export default function Home() {
  const [products, setProducts] = useState<product[]>([]);

  useState(() => {
    const fetchProducts = async () => {
      const res = await fetch('http://localhost/product/product.php');
      const data = await res.json();
      setProducts(data);
    }
    fetchProducts();
  }, []);

  return (
    <div>
      <h1>Product List</h1>
      <ul>
        {products.map((product) => (
          <li key={product.id}>
            {product.name} - Rp. {product.price} - Stock {product.stock}
          </li>
        ))}
      </ul>
    </div>
  );
};
