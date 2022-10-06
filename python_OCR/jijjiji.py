import easyocr
import cv2
import matplotlib.pyplot as plt
reader = easyocr.Reader(['en'], gpu=False)
image = cv2.imread('p2.jpg')
result = reader.readtext('p2.jpg')
Total = []
for (bbox, text, prob) in result:
    Total.append(text)
    (tl, tr, br, bl) = bbox
    tl = (int(tl[0]), int(tl[1]))
    tr = (int(tr[0]), int(tr[1]))
    br = (int(br[0]), int(br[1]))
    bl = (int(bl[0]), int(bl[1]))
    cv2.rectangle(image, tl, br, (0, 255, 0), 1)
    cv2.putText(image, text, (tl[0], tl[1] - 2),
                cv2.FONT_HERSHEY_SIMPLEX, 0.4, (255, 0, 0), 1)
plt.rcParams['figure.figsize'] = (16, 16)
plt.imshow(image)
plt.show()
reader = easyocr.Reader(['en'], gpu=False)
result = reader.readtext("p2.jpg")
print(result[8])
