//
//  SectionCell.swift
//  CampusOrientation
//
//  Created by Chiara Paventa on 16/07/2019.
//  Copyright © 2019 Chiara Paventa. All rights reserved.
//

import UIKit

class SectionCell: UITableViewCell {

    @IBOutlet weak var title: UILabel!
    @IBOutlet weak var switchObj: MySwitch!
    
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
