

import bpy
import struct
from bpy import context
from mathutils import Euler
import math

bpy.ops.wm.open_mainfile(filepath="C:/xampp/htdocs/brickspace/Codebase/renderer/res/avatar2.blend")
def hex_to_rgb(value):
    gamma = 2.05
    lv = len(value)
    fin = list(int(value[i:i + lv // 3], 16) for i in range(0, lv, lv // 3))
    r = pow(fin[0] / 255, gamma)
    g = pow(fin[1] / 255, gamma)
    b = pow(fin[2] / 255, gamma)
    fin.clear()
    fin.append(r)
    fin.append(g)
    fin.append(b)
    return tuple(fin)



bpy.data.objects["Torso"].select = True
bpy.data.objects["Torso"].active_material.diffuse_color = hex_to_rgb("000000")
bpy.data.objects["Head"].select = True
bpy.data.objects["Head"].active_material.diffuse_color = hex_to_rgb("ECC494")
bpy.data.objects["LeftArm"].select = True
bpy.data.objects["LeftArm"].active_material.diffuse_color = hex_to_rgb("ECC494")
bpy.data.objects["RightArm"].select = True
bpy.data.objects["RightArm"].active_material.diffuse_color = hex_to_rgb("ECC494")
bpy.data.objects["LeftLeg"].select = True
bpy.data.objects["LeftLeg"].active_material.diffuse_color = hex_to_rgb("ECC494")
bpy.data.objects["RightLeg"].select = True
bpy.data.objects["RightLeg"].active_material.diffuse_color = hex_to_rgb("ECC494")






HeadImg = bpy.data.images.load(filepath="C:/xampp/htdocs/brickspace/Codebase/cdn/img/face.png")
HeadTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
HeadTex.image = HeadImg
Headslot = bpy.data.objects["Head"].active_material.texture_slots.add()
Headslot.texture = HeadTex
  

for ob in bpy.context.scene.objects:
    if ob.type == "MESH":
        ob.select = True
        bpy.context.scene.objects.active = ob
    else:
        ob.select = False
bpy.ops.object.join()
bpy.ops.view3d.camera_to_view_selected()
origAlphaMode = bpy.data.scenes["Scene"].render.alpha_mode
bpy.data.scenes["Scene"].render.alpha_mode = "TRANSPARENT"
bpy.data.scenes["Scene"].render.alpha_mode = origAlphaMode


bpy.data.scenes["Scene"].render.filepath = "C:/xampp/htdocs/brickspace/Codebase/cdn/img/avatar/c4ca4238a0b923820dcc509a6f75849b.png"
bpy.ops.object.select_all(action="SELECT")
bpy.ops.view3d.camera_to_view_selected()
bpy.ops.render.render( write_still=True )

