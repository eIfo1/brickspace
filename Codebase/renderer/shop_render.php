<?php
$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require($serverRoot .'/config/config.php');
header('Content-Type: application/json');

$sql = "SELECT * FROM item WHERE id = :id";
$i = $conn->prepare($sql);
$i->execute(array(":id" => $id));
$i = $i->fetch();

if($i['type'] == "hats") {
  $item = '
hatpath = "' . $serverRoot . '/renderer/res/models/hats/' . $i['id'] .'.obj"
import_hat = bpy.ops.import_scene.obj(filepath=hatpath)
hat = bpy.context.selected_objects[0]
bpy.context.selected_objects[0].data.name = "hat"
hatImg = bpy.data.images.load(filepath="' . $serverRoot . '/renderer/res/textures/hats/'. $i['id'] . '.png")
hatTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
hatTex.image = hatImg
hatMat = bpy.data.materials.new("MaterialName")
hatMat.diffuse_shader = "LAMBERT"
hatSlot = hatMat.texture_slots.add()
hatSlot.texture = hatTex
hat.active_material = hatMat
';
}



$avatarImport = '
import bpy
import struct
from bpy import context
from mathutils import Euler
import math

bpy.ops.wm.open_mainfile(filepath="' . $serverRoot . '/renderer/res/avatar2.blend")
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

';

$saveBoiler = '
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
';

$colors = '
bpy.data.objects["Torso"].select = True
bpy.data.objects["Torso"].active_material.diffuse_color = hex_to_rgb("65E72B")
bpy.data.objects["Head"].select = True
bpy.data.objects["Head"].active_material.diffuse_color = hex_to_rgb("E7B541")
bpy.data.objects["LeftArm"].select = True
bpy.data.objects["LeftArm"].active_material.diffuse_color = hex_to_rgb("E7B541")
bpy.data.objects["RightArm"].select = True
bpy.data.objects["RightArm"].active_material.diffuse_color = hex_to_rgb("E7B541")
bpy.data.objects["LeftLeg"].select = True
bpy.data.objects["LeftLeg"].active_material.diffuse_color = hex_to_rgb("0070fa")
bpy.data.objects["RightLeg"].select = True
bpy.data.objects["RightLeg"].active_material.diffuse_color = hex_to_rgb("0070fa")
';


$face = '
HeadImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/face.png")
HeadTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
HeadTex.image = HeadImg
Headslot = bpy.data.objects["Head"].active_material.texture_slots.add()
Headslot.texture = HeadTex
';

$shirt = '
LeftArmImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/template.png")
LeftArmTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
LeftArmTex.image = LeftArmImg
LeftArmslot = bpy.data.objects["LeftArm"].active_material.texture_slots.add()
LeftArmslot.texture = LeftArmTex
RightArmImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/template.png")
RightArmTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
RightArmTex.image = RightArmImg
RightArmslot = bpy.data.objects["RightArm"].active_material.texture_slots.add()
RightArmslot.texture = RightArmTex
TorsoImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/template.png")
TorsoTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
TorsoTex.image = TorsoImg
Torsolot = bpy.data.objects["Torso"].active_material.texture_slots.add()
Torsolot.texture = TorsoTex
';

$pants = '
LeftLegImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/template.png")
LeftLegTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
LeftLegTex.image = LeftLegImg
LeftLegslot = bpy.data.objects["LeftLeg"].active_material.texture_slots.add()
LeftLegslot.texture = LeftLegTex
RightLegImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/template.png")
RightLegTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
RightLegTex.image = RightLegImg
RightLegslot = bpy.data.objects["RightLeg"].active_material.texture_slots.add()
RightLegslot.texture = RightLegTex
';


$hat = '
hatpath = "' . $serverRoot . '/renderer/res/models/hats/263.obj"
import_hat = bpy.ops.import_scene.obj(filepath=hatpath)
hat = bpy.context.selected_objects[0]
bpy.context.selected_objects[0].data.name = "hat"
hatImg = bpy.data.images.load(filepath="' . $serverRoot . '/renderer/res/textures/hats/263.png")
hatTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
hatTex.image = hatImg
hatMat = bpy.data.materials.new("MaterialName")
hatMat.diffuse_shader = "LAMBERT"
hatSlot = hatMat.texture_slots.add()
hatSlot.texture = hatTex
hat.active_material = hatMat
';

$hat2 = '
hat2path = "' . $serverRoot . '/renderer/res/models/hats/6.obj"
import_hat2 = bpy.ops.import_scene.obj(filepath=hat2path)
hat2 = bpy.context.selected_objects[0]
bpy.context.selected_objects[0].data.name = "hat2"
hat2Img = bpy.data.images.load(filepath="' . $serverRoot . '/renderer/res/textures/hats/6.png")
hat2Tex = bpy.data.textures.new("ColorTex", type = "IMAGE")
hat2Tex.image = hat2Img
hat2Mat = bpy.data.materials.new("MaterialName")
hat2Mat.diffuse_shader = "LAMBERT"
hat2Slot = hat2Mat.texture_slots.add()
hat2Slot.texture = hat2Tex
hat2.active_material = hat2Mat
';

$save = '
bpy.data.scenes["Scene"].render.filepath = "' . $serverRoot . '/cdn/img/shop/'. md5($id)  . '.png"
bpy.ops.object.select_all(action="SELECT")
bpy.ops.view3d.camera_to_view_selected()
bpy.ops.render.render( write_still=True )
';


$python = "
$avatarImport
$item
$colors
$face
$saveBoiler
$save
";

$pyFileName = "" . $serverRoot . "/renderer/python/1_shop.py";

file_put_contents($pyFileName, $python);


// Weird issue where blender wont start on local servers if you dont have this line about the path in there
putenv('PATH=' . $_SERVER['PATH']);
                   //   run in back       script       server path                 link           file | other shit idk what does
$output = exec("blender --background -t 5 --python " . $_SERVER['DOCUMENT_ROOT'] . '/renderer/python/' .  "1_shop.py -noaudio -nojoystick");

header('location: /shop');
die;