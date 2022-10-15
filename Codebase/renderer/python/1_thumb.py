

import bpy
import struct
from bpy import context
from mathutils import Euler
import math

bpy.ops.wm.open_mainfile(filepath="C:/xampp/htdocs/robloxclone/Codebase/renderer/res/avatar2.blend")
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


hatpath = "C:/xampp/htdocs/robloxclone/Codebase/renderer/res/models/hats/263.obj"
import_hat = bpy.ops.import_scene.obj(filepath=hatpath)
hat = bpy.context.selected_objects[0]
bpy.context.selected_objects[0].data.name = "hat"
hatImg = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/renderer/res/textures/hats/263.png")
hatTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
hatTex.image = hatImg
hatMat = bpy.data.materials.new("MaterialName")
hatMat.diffuse_shader = "LAMBERT"
hatSlot = hatMat.texture_slots.add()
hatSlot.texture = hatTex
hat.active_material = hatMat


hat2path = "C:/xampp/htdocs/robloxclone/Codebase/renderer/res/models/hats/6.obj"
import_hat2 = bpy.ops.import_scene.obj(filepath=hat2path)
hat2 = bpy.context.selected_objects[0]
bpy.context.selected_objects[0].data.name = "hat2"
hat2Img = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/renderer/res/textures/hats/6.png")
hat2Tex = bpy.data.textures.new("ColorTex", type = "IMAGE")
hat2Tex.image = hat2Img
hat2Mat = bpy.data.materials.new("MaterialName")
hat2Mat.diffuse_shader = "LAMBERT"
hat2Slot = hat2Mat.texture_slots.add()
hat2Slot.texture = hat2Tex
hat2.active_material = hat2Mat


LeftArmImg = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/cdn/img/template.png")
LeftArmTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
LeftArmTex.image = LeftArmImg
LeftArmslot = bpy.data.objects["LeftArm"].active_material.texture_slots.add()
LeftArmslot.texture = LeftArmTex
RightArmImg = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/cdn/img/template.png")
RightArmTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
RightArmTex.image = RightArmImg
RightArmslot = bpy.data.objects["RightArm"].active_material.texture_slots.add()
RightArmslot.texture = RightArmTex
TorsoImg = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/cdn/img/template.png")
TorsoTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
TorsoTex.image = TorsoImg
Torsolot = bpy.data.objects["Torso"].active_material.texture_slots.add()
Torsolot.texture = TorsoTex


LeftLegImg = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/cdn/img/template.png")
LeftLegTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
LeftLegTex.image = LeftLegImg
LeftLegslot = bpy.data.objects["LeftLeg"].active_material.texture_slots.add()
LeftLegslot.texture = LeftLegTex
RightLegImg = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/cdn/img/template.png")
RightLegTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
RightLegTex.image = RightLegImg
RightLegslot = bpy.data.objects["RightLeg"].active_material.texture_slots.add()
RightLegslot.texture = RightLegTex


HeadImg = bpy.data.images.load(filepath="C:/xampp/htdocs/robloxclone/Codebase/cdn/img/face.png")
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


bpy.ops.object.select_all(action="SELECT")
bpy.ops.view3d.camera_to_view_selected()

obj = bpy.data.objects["Camera"]
obj.location.x = 2.19646
obj.location.y = -4.36904
obj.location.z = 8.64529

bpy.data.scenes["Scene"].render.filepath = "C:/xampp/htdocs/robloxclone/Codebase/cdn/img/avatar/thumbnail/c4ca4238a0b923820dcc509a6f75849b.png"
bpy.ops.render.render( write_still=True )

