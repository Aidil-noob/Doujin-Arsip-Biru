from pdf2image import convert_from_path

# ganti dengan file pdf kamu
pdf_path = "/sdcard/'Doujin Blue Archive'/Doujin Miyako.pdf"

images = convert_from_path(pdf_path)

for i, img in enumerate(images):
    img.save(f"page_{i+1}.jpg", "JPEG")