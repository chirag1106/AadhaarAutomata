import cv2
import numpy as np
from skimage.filters import threshold_sauvola
import matplotlib as plt
from corner_edge_detection import get_corner_of_document
from perspective import perspective
import pytesseract
from pytesseract import Output
from PIL import Image

pytesseract.pytesseract.tesseract_cmd = 'C:/OCR/Tesseract-OCR/tesseract.exe'

def thresh(img):
    window_size = 25

    thresh_sauvola = threshold_sauvola(gray_img, window_size=window_size)    
    binary_sauvola = np.array(np.where(gray_img>thresh_sauvola,255,0),dtype = np.float32)
    
    inv_image = np.array(np.where(binary_sauvola==0,255,0),dtype = np.float32)
    kernel = cv2.getStructuringElement(cv2.MORPH_RECT, (2 ,2))
    dilation = cv2.dilate(inv_image,kernel,iterations = 1)
    closing = cv2.morphologyEx(dilation, cv2.MORPH_CLOSE, kernel)

    inv_image = np.array(np.where(closing==0,255,0),dtype = np.float32)
    
    return inv_image

def coord(img):    
    gray = np.float32(img)
    corners = cv2.goodFeaturesToTrack(gray, 27, 0.01, 10)
    return np.int0(corners)

img = cv2.imread('./adhaar.jpg')
# corner = get_corner_of_document(img)
# pr_img = perspective(corner, img)
gray_img = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
thresh_img = thresh(gray_img)

g_img = cv2.GaussianBlur(thresh_img, (5,5), 0)
g_img = 255 - g_img

im_pil = Image.fromarray(g_img)
im_pil = im_pil.convert("L")
d = pytesseract.image_to_data(im_pil, output_type=Output.DICT ,lang='eng', config='--psm 6')

aadhar_num = ""
for idx in range(len(d['text'])):
    text = d['text'][idx]
    try:
        number = int(text)
        if(len(text)==4):
            aadhar_num += text 

        if len(aadhar_num)==12:
            break
    except:
        pass
# aadhar_num = int(aadhar_num)
print("adhaar number :",aadhar_num)

# cv2.imshow("out", img)
# cv2.waitKey(0)