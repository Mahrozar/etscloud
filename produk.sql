CREATE TABLE produk (
  id SERIAL PRIMARY KEY,
  nama VARCHAR(100),
  harga NUMERIC(10,2),
  stok INTEGER,
  deskripsi TEXT
);

ALTER TABLE produk ADD COLUMN gambar_url TEXT;

SELECT column_name
FROM information_schema.columns
WHERE table_name = 'produk';


INSERT INTO produk (nama, harga, stok, deskripsi, gambar_url)
VALUES 
('Laptop', 25000000, 5, 'Laptop dengan chip M1, RAM 8GB, SSD 256GB, cocok untuk kerja dan gaming ringan.', 'https://product-images-uts.s3.amazonaws.com/Laptop.jpg');

INSERT INTO produk (nama, harga, stok, deskripsi, gambar_url) 
VALUES ('Laptop', 10000000, 5, 'Laptop gaming', 'https://link-to-image.com/laptop.jpg')