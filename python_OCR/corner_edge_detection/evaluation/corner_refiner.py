''' Document Localization using Recursive CNN
 Maintainer : Khurram Javed
 Email : kjaved@ualberta.ca '''

import numpy as np
import torch
from PIL import Image
from torchvision import transforms

import corner_edge_detection.model as model


class corner_finder():
    def __init__(self, CHECKPOINT_DIR):

        self.model = model.ModelFactory.get_model("resnet", "corner")
        self.model.load_state_dict(torch.load(CHECKPOINT_DIR, map_location='cpu'))
        if torch.cuda.is_available():
            self.model.cuda()
        self.model.eval()

    def get_location(self, img, retainFactor=0.85):
        with torch.no_grad():
            ans_x = 0.0
            ans_y = 0.0

            o_img = np.copy(img)

            y = [0, 0]
            x_start = 0
            y_start = 0
            up_scale_factor = (img.shape[1], img.shape[0])

            myImage = np.copy(o_img)

            test_transform = transforms.Compose([transforms.Resize([32, 32]),
                                                 transforms.ToTensor()])

            CROP_FRAC = retainFactor
            while (myImage.shape[0] > 10 and myImage.shape[1] > 10):

                img_temp = Image.fromarray(myImage)
                img_temp = test_transform(img_temp)
                img_temp = img_temp.unsqueeze(0)

                if torch.cuda.is_available():
                    img_temp = img_temp.cuda()
                response = self.model(img_temp).cpu().data.numpy()
                response = response[0]

                response_up = response

                response_up = response_up * up_scale_factor
                y = response_up + (x_start, y_start)
                x_loc = int(y[0])
                y_loc = int(y[1])

                if x_loc > myImage.shape[1] / 2:
                    start_x = min(x_loc + int(round(myImage.shape[1] * CROP_FRAC / 2)), myImage.shape[1]) - int(round(
                        myImage.shape[1] * CROP_FRAC))
                else:
                    start_x = max(x_loc - int(myImage.shape[1] * CROP_FRAC / 2), 0)
                if y_loc > myImage.shape[0] / 2:
                    start_y = min(y_loc + int(myImage.shape[0] * CROP_FRAC / 2), myImage.shape[0]) - int(
                        myImage.shape[0] * CROP_FRAC)
                else:
                    start_y = max(y_loc - int(myImage.shape[0] * CROP_FRAC / 2), 0)

                ans_x += start_x
                ans_y += start_y

                myImage = myImage[start_y:start_y + int(myImage.shape[0] * CROP_FRAC),
                          start_x:start_x + int(myImage.shape[1] * CROP_FRAC)]
                img = img[start_y:start_y + int(img.shape[0] * CROP_FRAC),
                      start_x:start_x + int(img.shape[1] * CROP_FRAC)]
                up_scale_factor = (img.shape[1], img.shape[0])

            ans_x += y[0]
            ans_y += y[1]
            return (int(round(ans_x)), int(round(ans_y)))


if __name__ == "__main__":
    pass
