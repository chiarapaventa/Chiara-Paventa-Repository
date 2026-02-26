//
//  MySwitch.swift
//  CampusOrientation
//
//  Created by Chiara Paventa on 15/07/2019.
//  Copyright © 2019 Chiara Paventa. All rights reserved.
//

import UIKit

class MySwitch: UISwitch {
    
    var text: String
    var indexSection: Int?
    
    override init(frame: CGRect) {
        self.text = ""
        self.indexSection = 0
        super.init(frame: frame)
    }
    
    required init?(coder aDecoder: NSCoder) {
        self.text = ""
        super.init(coder: aDecoder)
    }
    
    
    /*
    // Only override draw() if you perform custom drawing.
    // An empty implementation adversely affects performance during animation.
    override func draw(_ rect: CGRect) {
        // Drawing code
    }
    */

}
