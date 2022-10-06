import cv2
import numpy as np
import base64
import os
from PIL import Image
from io import BytesIO 
import corner_edge_detection.evaluation as evaluation

def args_processor():
    from argparse import Namespace
    import yaml    
    return Namespace(
        imagePath="./sample.jpg",
        outputPath="./result",
        retainFactor=0.85,
        cornerModel="./corner_edge_detection/checkpoints/corner.pb",
        documentModel="./corner_edge_detection/checkpoints/document.pb",
    )

def get_corner_of_document(image):
    args = args_processor()

    corners_extractor = evaluation.corner_extractor.GetCorners(args.documentModel)
    corner_refiner = evaluation.corner_refiner.corner_finder(args.cornerModel)

    extracted_corners = corners_extractor.get(image)
    corner_address = []
    
    # Refine the detected corners using corner refiner
    image_name = 0
    for corner in extracted_corners:
        image_name += 1
        corner_img = corner[0]
        refined_corner = np.array(corner_refiner.get_location(corner_img, 0.85))

        # Converting from local co-ordinate to global co-ordinates of the image
        refined_corner[0] += corner[1]
        refined_corner[1] += corner[2]

        # Final results
        corner_address.append(refined_corner)
        
    corner_address = np.float32(corner_address)
    
    return corner_address

if __name__ == '__main__':
    args = args_processor()
    
    image = cv2.imread(args.imagePath)
    assert len(image)!=0
    result = get_corner_of_document(image)
    
    print(result)